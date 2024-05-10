<!-- Logout Modal-->
<div class="modal fade" id="violation-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Violation</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="d-flex justify-content-center flex-column border-bottom" id="violationModalTable" width="100%" cellspacing="0">
                    <thead class="w-100">
                        <tr class="d-flex justify-content-between border-bottom">
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody class="w-100">
                        <?php
                        $violationQuery = "SELECT * FROM violation";
                        $violationStatement = $pdo->query($violationQuery);
                        $violations = $violationStatement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($violations as $violation) {
                        ?>

                            <tr class="d-flex justify-content-between align-violations-center border-bottom py-1 select-violation" data-violation-id="<?php echo $violation['violation_id'] ?>">
                                <td class="p-0 m-0 w-100">
                                    <a href="#" class="d-flex align-violations-center text-decoration-none
                                        text-gray-700 flex-gap w-100">
                                        <div>
                                            <div class="text">
                                                <span class="d-none d-md-inline">Description:</span>
                                                <?php echo $violation['description'] ?>
                                            </div>
                                            <div class="sub-title">
                                                Id: <?php echo $violation['violation_id'] ?></div>

                                        </div>
                                    </a>

                                </td>
                                <td>
                                    <a class="btn btn-primary py-1">
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