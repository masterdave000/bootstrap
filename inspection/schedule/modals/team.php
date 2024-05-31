<!-- Logout Modal-->
<div class="modal fade" id="team-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Team</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
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
                        $teamQuery = "SELECT DISTINCT team_id, team_name, inspector_firstname, inspector_midname, inspector_lastname, inspector_suffix, team_name, inspector_img_url FROM inspector_team_view WHERE team_role = :team_role";

                        $bindings = [];

                        if ($_SESSION['role'] !== 'Administrator') {
                            $teamQuery .= " AND inspector_id = :inspector_id";
                            $bindings[':inspector_id'] = $user_inspector_id;
                        }
                        $bindings[':team_role'] = 'Leader';
                        $teamQuery .= " ORDER BY team_member_id DESC";

                        $teamStatement = $pdo->prepare($teamQuery);
                        $teamStatement->execute($bindings);

                        $teams = $teamStatement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($teams as $team) {
                            $team_id = htmlspecialchars(ucwords($team['team_id']));

                            $firstname = htmlspecialchars(ucwords($team['inspector_firstname']));
                            $midname = htmlspecialchars(ucwords($team['inspector_midname'] ? mb_substr($team['inspector_midname'], 0, 1, 'UTF-8') . "." : ""));
                            $lastname = htmlspecialchars(ucwords($team['inspector_lastname']));
                            $suffix = htmlspecialchars(ucwords($team['inspector_suffix']));
                            $fullname = trim($firstname . ' ' . $midname . ' ' . $lastname . ' ' . $suffix);

                        ?>
                            <tr class="d-flex justify-content-between align-inspectors-center border-bottom py-1 select-schedule-inspector" data-team-id="<?php echo $team['team_id'] ?>">
                                <td class="p-0 m-0 w-100">
                                    <a href="#" class="d-flex align-inspectors-center text-decoration-none
                                    text-gray-700 flex-gap w-100">
                                        <div class="image-container img-fluid">
                                            <img src="<?php echo SITEURL ?>inspection/inspector/images/<?php echo $team['inspector_img_url'] ?? 'default.png' ?>" alt="inspector-image" class="img-fluid rounded-circle" />
                                        </div>

                                        <div>
                                            <div class="text">
                                                <?php echo $fullname ?>
                                            </div>
                                            <div class="sub-title">
                                                Team Name: <?php echo $team['team_name'] ?></div>

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