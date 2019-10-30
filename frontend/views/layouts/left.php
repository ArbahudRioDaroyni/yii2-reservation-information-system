<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site']],
                    [
                        'label' => 'Admin',
                        'icon' => 'user',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Customer', 'icon' => 'user', 'url' => ['/customer-profile'],],
                            ['label' => 'Sesi', 'icon' => 'dashboard', 'url' => ['/list-calculation'],],
                            ['label' => 'Tipe Kamar', 'icon' => 'dashboard', 'url' => ['/hotel-room-type'],],
                            ['label' => 'Tipe Kendaraan', 'icon' => 'dashboard', 'url' => ['/list-vehicle-type'],],
                        ],
                    ],
                    [
                        'label' => 'Booking Service',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Hotel', 'icon' => 'dashboard', 'url' => ['/hotel-order'],],
                            ['label' => 'Message', 'icon' => 'dashboard', 'url' => ['/massage-order'],],
                            ['label' => 'Towing', 'icon' => 'dashboard', 'url' => ['/towing-order'],],
                            ['label' => 'Food', 'icon' => 'dashboard', 'url' => ['/food-order'],],
                            ['label' => 'Cleaning', 'icon' => 'dashboard', 'url' => ['/cleaning-order'],],
                        ],
                    ],
                    [
                        'label' => 'Produk Service',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Hotel', 'icon' => 'dashboard', 'url' => ['/hotel'],],
                            ['label' => 'Massage', 'icon' => 'dashboard', 'url' => ['/massage'],],
                            ['label' => 'Towing', 'icon' => 'dashboard', 'url' => ['/towing'],],
                            ['label' => 'Food', 'icon' => 'dashboard', 'url' => ['/food'],],
                            ['label' => 'Cleaning', 'icon' => 'dashboard', 'url' => ['/cleaning'],],
                        ],
                    ],
                    ['label' => 'Payment Service', 'icon' => 'times', 'url' => ['/payment']],
                    ['label' => 'News Blog', 'icon' => 'times', 'url' => ['/debug']],
                    ['label' => 'Promo', 'icon' => 'times', 'url' => ['/debug']],
                    ['label' => 'Banner', 'icon' => 'times', 'url' => ['/debug']],
                    ['label' => 'User', 'icon' => 'times', 'url' => ['/debug']],
                ],
            ]
        ) ?>

    </section>

</aside>
