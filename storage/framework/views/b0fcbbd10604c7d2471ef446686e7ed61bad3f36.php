<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="/css/slick.css">
    <style>
        .slick-initialized .swipe-tab-content {
            position: relative;
            min-height: 365px;
        }

        .slick-initialized .slick-slide {
            display: flex !important;
        }

        @media  screen and (min-width: 767px) {
            .slick-initialized .swipe-tab-content {
                min-height: 500px;
            }
        }

        .slick-initialized .swipe-tab {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            height: 50px;
            background: none;
            border: 0;
            color: #757575;
            cursor: pointer;
            text-align: center;
            border-bottom: 2px solid transparent;
            -webkit-transition: all 0.5s;
            transition: all 0.5s;
        }

        .slick-initialized .swipe-tab:hover {
            color: #000;
        }

        .slick-initialized .swipe-tab:focus {
            outline: none;
            box-shadow: none;
        }

        .slick-initialized .slick-slide:focus {
            outline: none;
            box-shadow: none;
        }

        .slick-initialized .swipe-tab.active-tab {
            border-bottom-color: #00CA4C;
            color: #00CA4C;
            font-weight: 500;
            display: flex;
        }

        .good-card-available-date {
            font-size: 12px;
            font-weight: 500;
            color: #999999;
            padding-bottom: 4px;
            display: flex;
            align-items: center;
        }

        .good-card-title {
            font-size: 16px;
            font-weight: bold;
        }

        .good-card-original-price {
            font-size: 12px;
            font-weight: 400;
            color: #999;
            text-decoration: line-through;
        }

        .good-card-price-title {
            color: black;
        }

        .good-card-price-sub-title {
            color: #999;
            font-size: 12px;
        }

        .good-card-price {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            display: flex;
            align-items: baseline;
            margin-bottom: 6px;
            color: red;
        }

        .good-card-price-section-left {
            background: #eee;
            border-radius: 5px 0 0 5px;
            border-right: 1px solid #fff;
        }

        .good-card-price-section-right {
            background: #eee;
            border-radius: 0 5px 5px 0;
            border-left: 1px solid #fff;
        }

        .good-card-coupon-text {
            font-size: 13px;
            font-weight: bold;
            color: #d91c84;
            margin-top: auto;
            margin-left: 10px;
            margin-right: 10px;
            white-space: nowrap;
            margin-bottom: 1px;
        }

        .good-card-buy-cnt {
            font-size: 12px;
            font-weight: 400;
            color: #999;
            margin-top: 1rem;
        }


        .probootstrap-media .media-body {
            padding: 2em 2em .5em;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="probootstrap-cover overflow-hidden relative"
             style="background-image: url('images/recommend_1.jpg'); padding: 2em 0 0"
             data-stellar-background-ratio="0.5"
             id="section-home">
        <div class="overlay"></div>
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md">
                    <p class="lead mb-5 probootstrap-animate" style="margin: 0 !important;"><a href="#" target="_blank">다른지역보기
                            <i
                                class="fa fa-angle-down"></i></a></p>
                    <h2 class="heading mb-2 display-5 font-light probootstrap-animate">서울시 - 종로구</h2>
                </div>
            </div>
        </div>

    </section>
    <!-- END section -->

    <div class="sub-header">
        <div class="swipe-tabs">
            <div class="swipe-tab" onclick="roomAjax('모텔')">모텔</div>
            <div class="swipe-tab" onclick="roomAjax('호텔')">호텔</div>
            <div class="swipe-tab" onclick="roomAjax('펜션')">펜션</div>
            <div class="swipe-tab" onclick="roomAjax('게스트하우스')">게스트하우스</div>
            <div class="swipe-tab" onclick="roomAjax('캠핑/글램핑')">캠핑/글램핑</div>
            <div class="swipe-tab" onclick="roomAjax('공간대여')">공간대여</div>
        </div>
    </div>

    <section class="probootstrap_section probootstrap_lg_pt-50" id="section-city-guides">
        <div class="container" id="roomList">
        </div>
    </section>
    <!-- END section -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="/js/slick.min.js"></script>
    <script>
        $(function () {
            'use strict';

            var $swipeTabsContainer = $('.swipe-tabs'),
                $swipeTabs = $('.swipe-tab'),
                currentIndex = 0,
                activeTabClassName = 'active-tab';

            $swipeTabsContainer.on('init', function (event, slick) {
                $swipeTabsContainer.removeClass('invisible');

                currentIndex = slick.getCurrent();
                $swipeTabs.removeClass(activeTabClassName);
                $('.swipe-tab[data-slick-index=' + currentIndex + ']').addClass(activeTabClassName);
            });

            $swipeTabsContainer.slick({
                // slidesToShow: 3.25,
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: false,
                infinite: false,
                swipeToSlide: true
            });


            $swipeTabs.on('click', function (event) {
                // gets index of clicked tab
                currentIndex = $(this).data('slick-index');
                $swipeTabs.removeClass(activeTabClassName);
                $('.swipe-tab[data-slick-index=' + currentIndex + ']').addClass(activeTabClassName);
                $swipeTabsContainer.slick('slickGoTo', currentIndex);
            });
            roomAjax("모텔");
        });

        function roomAjax(type) {
            $.ajax({
                url: '/product',
                type: "get",
                dataType: "json", data: {
                    'json': true,
                    'type' :type,
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
            }).done(function (response) {
                var data = response.datas;
                $("#roomList").html(data);
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/product/product.blade.php ENDPATH**/ ?>