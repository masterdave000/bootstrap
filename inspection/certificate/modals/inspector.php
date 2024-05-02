<!-- Logout Modal-->
<div class="modal fade" id="inspector-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Inspector</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="d-flex justify-content-center">
                    <thead>
                    </thead>
                    <tbody class="w-100">
                        <?php 
                                $inspectorQuery = "SELECT inspector_id, inspector_firstname, inspector_midname, inspector_lastname, inspector_suffix, inspector_img_url FROM inspector ORDER BY inspector_lastname";
                                $inspectorStatement = $pdo->query($inspectorQuery);
                                $inspectors = $inspectorStatement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($inspectors as $inspector) {

                                    $firstname = htmlspecialchars(ucwords($inspector['inspector_firstname']));
                                    $midname = htmlspecialchars(ucwords($inspector['inspector_midname'] ? mb_substr($inspector['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
                                    $lastname = htmlspecialchars(ucwords($inspector['inspector_lastname']));
                                    $suffix = htmlspecialchars(ucwords($inspector['inspector_suffix']));
                                    $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);
                            ?>
                        <tr class="d-flex justify-content-between align-inspectors-center border-bottom py-1 select-certificate-inspector"
                            data-inspector-id="<?php echo $inspector['inspector_id']?>">
                            <td class="p-0 m-0 w-100">
                                <a href="#" class="d-flex align-inspectors-center text-decoration-none
                                    text-gray-700 flex-gap w-100">
                                    <div class="image-container img-fluid">
                                        <img src="<?php echo SITEURL?>inspection/inspector/images/<?php echo $inspector['inspector_img_url'] ?? 'default.png'?>"
                                            alt="inspector-image" class="img-fluid rounded-circle" />
                                    </div>

                                    <div>
                                        <div class="text">
                                            <span class="d-none d-md-inline">Name:</span>
                                            <?php echo $fullname?>
                                        </div>
                                        <div class="sub-title">
                                            Id: <?php echo $inspector['inspector_id']?></div>

                                    </div>
                                </a>

                            </td>
                            <td>
                                <a class="btn btn-success py-1">
                                    Select
                                </a>
                            </td>
                        </tr>
                        <?php
                                }

                            ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>