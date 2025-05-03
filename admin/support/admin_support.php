<?php
session_start();
require '../../include/connect.php';

include_once '../../adminlayout/header.php';

// Fetch all tickets
$tickets = $conn->query("SELECT support_tickets.*, users.username FROM support_tickets 
    JOIN users ON support_tickets.user_id = users.id 
    ORDER BY support_tickets.created_at DESC");
?>



<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title"> All Support Tickets</h3>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
               
                <div class="col-xl-12 col-12">
                    <div class="box mb-20">
                        <div class="box-body pt-10">
                        <?php while ($ticket = $tickets->fetch_assoc()): ?>
                            <div class="mailbox-read-info">
                                <div class="d-flex align-items-center mb-10">
                                    <img src="<?= $web_url ?>front/assets/img/adminlogo.png" alt="user" width="40" class="rounded-circle mr-10">
                                    <div>
                                        <h5 class="mb-0"><?= htmlspecialchars($ticket['subject']) ?> by <?= $ticket['username'] ?> (<?= $ticket['status'] ?>)</span></h5>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="mailbox-read-message">
                                <p><?= nl2br(htmlspecialchars($ticket['message'])) ?></p>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="pull-center">
                                <a href="admin_reply.php?id=<?= $ticket['id'] ?>" class="btn btn-sm btn-success"><i class="fa fa-reply"></i> Reply</a>
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

<?php include_once __DIR__ . '/../../adminlayout/footer.php'; ?>

