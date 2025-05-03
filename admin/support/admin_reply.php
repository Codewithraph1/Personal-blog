<?php
session_start();
require '../../include/connect.php';

include_once '../../adminlayout/header.php';

$admin_id = $_SESSION['admin_id'];
$ticket_id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT support_tickets.*, users.username FROM support_tickets 
    JOIN users ON support_tickets.user_id = users.id 
    WHERE support_tickets.id = ?");
$stmt->bind_param("i", $ticket_id);
$stmt->execute();
$ticket = $stmt->get_result()->fetch_assoc();

if (!$ticket) {
    die("Ticket not found.");
}

// Handle reply
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO ticket_replies (ticket_id, sender_type, sender_id, message) 
        VALUES (?, 'admin', ?, ?)");
    $stmt->bind_param("iis", $ticket_id, $admin_id, $message);
    $stmt->execute();

    $conn->query("UPDATE support_tickets SET status = 'answered' WHERE id = $ticket_id");
}

$replies = $conn->query("SELECT * FROM ticket_replies WHERE ticket_id = $ticket_id ORDER BY created_at ASC");
?>

<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title"> Support Ticket</h3>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-xl-12 col-12">
                    
                    <div class="box mb-20">
                        <div class="box-body pt-10">
                            <div class="mailbox-read-info">
                                <div class="d-flex align-items-center mb-10">
                                    <img src="<?= $web_url ?>front/assets/img/adminlogo.png" alt="user" width="40" class="rounded-circle mr-10">
                                    <div>
                                        <h5 class="mb-0">Ticket from <?= $ticket['username'] ?>: <?= htmlspecialchars($ticket['subject']) ?></span></h5>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="mailbox-read-message">
                                <p><?= nl2br(htmlspecialchars($ticket['message'])) ?></p>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="pull-right">
                                <h3>Replies</h3>
                            </div>
                        </div>
                        <?php while ($reply = $replies->fetch_assoc()): ?>
                        <div class="box-body pt-10">
                            <div class="mailbox-read-info">
                                <div class="d-flex align-items-center mb-10">
                                    <img src="<?= $web_url ?>front/assets/img/adminlogo.png" alt="user" width="40" class="rounded-circle mr-10">
                                    <div>
                                        <h5 class="mb-0"><?= ucfirst($reply['sender_type']) ?>:</span></h5>
                                        <small><?= $reply['created_at'] ?></small>
                                    </div>
                                </div>
                            </div>

                            <div class="mailbox-read-message">
                                <p><?= nl2br(htmlspecialchars($reply['message'])) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>

                                <!-- /. box -->
                </div>
                <div class="col-lg-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Send Reply</h4>
                        </div>

                        <form  method="post" >
                            <div class="box-body">
                                <h4 class="mt-0 mb-20">Reply</h4>

                                         
                                
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea rows="10" class="form-control" name="message" placeholder="Message" required></textarea>
                                </div>

                                
                            </div>

                            <div class="box-footer">
                                <button type="submit"  class="btn btn-rounded btn-success pull-right">Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
               
             </div>
        </section>
    </div>
</div>

<?php include_once __DIR__ . '/../../adminlayout/footer.php'; ?>
