<?php

use App\Models\Category;
use App\Models\Product;

$list_category = Category::where([['parent_id', '=', '0'], ['status', '=', '1']])
->orderBy('sort_order', 'asc')->take(3)->get();
$title = "TRANG CHỦ";
$metakey = "";
$metadesc = "";
?>

<?php require_once('views/frontend/header.php'); ?>
<?php require_once('views/frontend/mod_mainmenu.php'); ?>

<?php require_once('views/frontend/mod_slider.php'); ?>
<div class="mid-content">
    <div class="container">
        <?php foreach ($list_category as $cat) : ?>
            <?php
            $listcatid = array();
            array_push($listcatid, $cat->id);
            $list_category_1 = Category::where([['status', '=', '1'], ['parent_id', '=', $cat->id]])
                ->get();
            if (count($list_category_1) > 0) {
                foreach ($list_category_1 as $cat1) {
                    array_push($listcatid, $cat1->id);
                    $list_category_2 = Category::where([['status', '=', '1'], ['parent_id', '=', $cat1->id]])
                        ->get();
                    if (count($list_category_2) > 0) {
                        foreach ($list_category_2 as $cat2) {
                            array_push($listcatid, $cat2->id);
                            $list_category_3 = Category::where([['status', '=', '1'], ['parent_id', '=', $cat2->id]])
                                ->get();
                            if (count($list_category_3) > 0) {
                                foreach ($list_category_3 as $cat3) {
                                    array_push($listcatid, $cat3->id);
                                }
                            }
                        }
                    }
                }
            }
            $product_list = Product::where('status', '=', 1)->whereIn('category_id', $listcatid)
                ->orderBy('created_at', 'DESC')
                ->take(4)
                ->get();
            $total = Product::where([['status', '=', 1], ['category_id', $listcatid]])->count();
            ?>
            <?php if ($total > 0) : ?>
                <div class="product">
                    <div class="row my-5">
                        <div class="col-md-10 col-12 border-bottom border-4 px-0 mx-auto">
                            <div class="heading1 ">
                                <h2 class="title">
                                    <span class="d-md-inline-block d-none text-warning "> | </span>
                                    <a href="index.php?option=product&cat=<?= $cat->slug ?>" class="text-decoration-none text-bl_gr"><?= $cat->name ?></a>
                                </h2>
                            </div>
                            <div class="d-md-block d-none">
                                <a class="text-decoration-none btn-tab text-bl_gr" href="index.php?option=product&cat=<?= $cat->slug ?>" title="Xem thêm">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                    <div class="product_slide">
                        <div class="row mx-auto">
                            <div class="col-md-10 mx-auto">
                                <div class="row row-cols-1 row-cols-md-3 g-4">

                                    <?php foreach ($product_list as $product) : ?>

                                        <div class="col-md-3 col-6">
                                            <div class="card h-100 text-center shadow-product  port">
                                                <div class="card-header position-relative">
                                                    <?php if (($product->price_sale == null) || ($product->price_sale == $product->price)) $index = 0;
                                                    else $index = 1; ?>
                                                    <?php if ($index == 1) : ?>
                                                        <div style="max-height: 55px; max-width: 40px;" class="product-sale position-absolute top-0 end-0 bg-danger">
                                                            <div class="product-sale__small">off</div>
                                                            <span><strong> <?= (int)(((($product->price) - ($product->price_sale)) / ($product->price)) * 100) ?> %</strong></span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <a href="./product-detail.html"><img src="public/images/product/<?= $product->image ?>" class="card-img-top img-product img-md-product-3x" alt="<?= $product->image ?>"></a>
                                                </div>
                                                <div class="card-body ">

                                                    <a href="index.php?option=product&slug=<?= $product->slug ?>">
                                                        <h3 class="card-title fs-6 fs-7 text-bl_gr text-truncate"><?= $product->name ?></h3>
                                                    </a>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <?php if ($product->price_sale == 0) : ?>
                                                            <div class="col-md-6 col-12 mx-auto">
                                                                <h5 class="fs-6 fs-7 text-center text-danger"><?= number_format($product->price) ?>₫</h5>
                                                            </div>
                                                        <?php else : ?>
                                                            <div class="col-md-6 col-6 mx-auto">
                                                            <h5 class="fs-6 fs-7 text-center text-danger"><?= number_format($product->price_sale) ?>₫</h5>
                                                            </div>
                                                            <div class="col-md-6 col-6 mx-auto">
                                                                <h5 class="fs-6 fs-7 text-center text-decoration-line-through text-muted "><?= number_format($product->price) ?>₫</h5>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                </div>
                            </div>
                      
                        </div>
                    </div>

                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php require_once('views/frontend/footer.php'); ?>