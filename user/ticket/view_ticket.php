<?php
session_start();
require '../../include/connect.php';

include_once '../../userlayout/header.php';


$user_id = $_SESSION['user_id'];
$ticket_id = $_GET['id'] ?? 0;

// Validate access
$stmt = $conn->prepare("SELECT * FROM support_tickets WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $ticket_id, $user_id);
$stmt->execute();
$ticket = $stmt->get_result()->fetch_assoc();

if (!$ticket) {
    die("Ticket not found or unauthorized.");
}

// Fetch replies
$stmt = $conn->prepare("SELECT * FROM ticket_replies WHERE ticket_id = ? ORDER BY created_at ASC");
$stmt->bind_param("i", $ticket_id);
$stmt->execute();
$replies = $stmt->get_result();
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
                                    <h5 class="mb-0"><?= htmlspecialchars($ticket['subject']) ?></span></h5>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="mailbox-read-message">
                            <p><?= nl2br(htmlspecialchars($ticket['message'])) ?></p>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-center">
                            <h3>Replies</h3>
                        </div>
                    </div>
                    <?php while ($reply = $replies->fetch_assoc()): ?>
                    <div class="box-body pt-10">
                        <div class="mailbox-read-info">
                            <div class="d-flex align-items-center mb-10">
                                <img src="<?= $web_url ?>front/assets/img/adminlogo.png" alt="user" width="40" class="rounded-circle mr-10">
                                <div>
                                    <strong><?= ucfirst($reply['sender_type']) ?>:</strong>
                                    <h5 class="mb-0"><?= $reply['created_at'] ?></span></h5>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="mailbox-read-message">
                            <p><?= nl2br(htmlspecialchars($reply['message'])) ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
              

                                <!-- /. box -->
                    </div>
                </div>
            </section>
        </div>
    </div>

<?php include_once __DIR__ . '/../../userlayout/footer.php'; ?>

