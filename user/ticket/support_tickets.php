<?php
session_start();
ob_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../userlayout/header.php';

$user_id = $_SESSION['user_id']; // Set this on login

// Handle new ticket submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subject'], $_POST['message'])) {
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO support_tickets (user_id, subject, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $subject, $message);
    $stmt->execute();
    $stmt->close();
}

// Fetch user tickets
$stmt = $conn->prepare("SELECT * FROM support_tickets WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$tickets = $stmt->get_result();
?>

<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Submit Support Ticket</h3>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Submit Support Ticket</h4>
                        </div>

                        <form  method="post" >
                            <div class="box-body">
                                <h4 class="mt-0 mb-20">Ticket</h4>

                                <div class="form-group">
                                    <label>Subject:</label>
                                    <input class="form-control" type="text"  name="subject" placeholder="Subject" required>
                                </div >          
                                
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea rows="10" class="form-control" name="message" placeholder="Message" required></textarea>
                                </div>

                                
                            </div>

                            <div class="box-footer">
                                <button type="submit"  class="btn btn-rounded btn-success pull-right">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-12 col-12">
                <?php while ($ticket = $tickets->fetch_assoc()): ?>
                <div class="box mb-20">
                    <div class="box-body pt-10">
                        <div class="mailbox-read-info">
                            <div class="d-flex align-items-center mb-10">
                                <img src="<?= $web_url ?>front/assets/img/adminlogo.png" alt="user" width="40" class="rounded-circle mr-10">
                                <div>
                                    <h5 class="mb-0"><?= htmlspecialchars($ticket['subject']) ?> <span class="badge badge-info"><?= ucfirst($ticket['status']) ?></span></h5>
                                    <small><?= date("d M Y h:i A", strtotime($ticket['created_at'])) ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="mailbox-read-message">
                            <p><?= nl2br(htmlspecialchars($ticket['message'])) ?></p>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="view_ticket.php?id=<?= $ticket['id'] ?>" class="btn btn-sm btn-success"><i class="fa fa-reply"></i> View Replies</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>

                                <!-- /. box -->
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

<?php include_once __DIR__ . '/../../userlayout/footer.php'; ?>
