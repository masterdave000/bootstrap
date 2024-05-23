<div class="modal fade w-100" id="business-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Business</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-borderless d-flex flex-column justify-content-center" id="inspectorModalTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="d-flex justify-content-between border-bottom">
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $businessQuery = "SELECT DISTINCT schedule_id, bus_id, bus_name, bus_img_url, schedule_date FROM business_inspection_schedule_view WHERE schedule_date = CURDATE()";

                        $bindings = [];

                        if ($role !== 'Administrator') {
                            $businessQuery .= " AND inspector_id = :inspector_id";
                            $bindings[':inspector_id'] = $user_inspector_id;
                        }

                        $businessQuery .= " ORDER BY schedule_date";

                        $businessStatement = $pdo->prepare($businessQuery);
                        $businessStatement->execute($bindings);

                        while ($business = $businessStatement->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr class="d-flex justify-content-between align-items-center border-bottom py-1 select-business">
                                <td class="p-0 m-0 w-100">
                                    <a href="./add-inspection.php?schedule_id=<?= $business['schedule_id'] ?>" class="d-flex align-items-center text-decoration-none text-gray-700 flex-gap w-100">
                                        <div class="image-container img-fluid">
                                            <img src="./../business/images/<?= htmlspecialchars($business['bus_img_url'] ?? 'default-img.png') ?>" alt="business-image" class="img-fluid rounded-circle" />
                                        </div>

                                        <div>
                                            <div class="text">
                                                <?= htmlspecialchars($business['bus_name']) ?>
                                            </div>
                                            <div class="sub-title d-none d-md-flex">Inspection Schedule: <?= htmlspecialchars($business['schedule_date']) ?></div>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="./add-inspection.php?schedule_id=<?= $business['schedule_id'] ?>" class="btn btn-primary py-1">
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