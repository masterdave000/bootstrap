<!-- Logout Modal-->
<div class="modal fade" id="item-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="d-flex justify-content-center">
                    <thead>
                    </thead>
                    <tbody class="w-100">
                        <?php 
                                $itemQuery = "SELECT * FROM item_view ORDER BY item_name";
                                $itemStatement = $pdo->query($itemQuery);
                                $items = $itemStatement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($items as $item) {
                            ?>
                        <tr class="d-flex justify-content-between align-items-center border-bottom py-1 select-item"
                            data-item-id="<?php echo $item['item_id']?>">
                            <td class="p-0 m-0 w-100">
                                <a href="#" class="d-flex align-items-center text-decoration-none
                                text-gray-700 flex-gap w-100">
                                    <div class=" image-container img-fluid">
                                        <img src="./../item/images/<?php echo $item['img_url'] ?? 'default-img.png'?>"
                                            alt="inspector-image" class="img-fluid rounded-circle" />
                                    </div>

                                    <div>
                                        <div class="text">
                                            <span class="d-none d-md-inline">Name:</span>
                                            <?php echo $item['item_name']?>
                                        </div>
                                        <div class="sub-title d-none d-md-flex">
                                            <?php echo $item['category_name']?></div>

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