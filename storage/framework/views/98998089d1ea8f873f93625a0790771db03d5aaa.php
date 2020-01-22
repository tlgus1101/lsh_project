<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="/css/swiper.min.css">
  <style>
    #search {
      display: none;
    }
    .swiper-button-next:after, .swiper-container-rtl .swiper-button-prev:after {
      content: 'next';
      color: #aaa;
    }
    .swiper-button-prev:after, .swiper-container-rtl .swiper-button-next:after {
      content: 'prev';
      color: #aaa;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <form name="paging">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="url"/>
    <input type="hidden" name="type"/>
    <input type="hidden" name="idx"/>
    <input type="hidden" name="sido"/>
    <input type="hidden" name="sigungu"/>
  </form>

  <section class="probootstrap-cover overflow-hidden relative" style="background-image: url('<?php echo e($s3); ?>/images/bg.jpg');"
           data-stellar-background-ratio="0.5" id="section-home">
    <div class="overlay"></div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md">
          <div class="header-search-bar">
            <div class="inner">
              <div class="searchbar">
                <div class="main-header-title-text-box">
                  <div class="main-header-title-text">
                      어디로 떠나고 싶으세요 ?
                  </div>
                </div>
                <div class="input-group" style="position: relative;">
                  <img src="<?php echo e($s3); ?>/images/serchbar.svg" class="main-search-ic">
                  <input type="text" placeholder="지역명 또는 공간명을 검색하세요."  autocomplete="off" class="form-control" style="border-radius: 0;"
                         onkeyup="search(this.value);" onfocus="searchShow();" onblur="searchHide();" >
                  <div class="searchresult-container" id="search">
                    <div class="searchresult-content searchresult-items">
                      <div class="searchresultitem-container searchresultitem-container-searched" id="searchresult">
                        <div class="searchresultitem-container">
                          <div class="searchresultitem-title">핫스팟</div>
                          <div class="searchresultitem-items">
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '경기', '가평군');">가평</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '제주특별자치도', '서귀포시');">서귀포</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '제주특별자치도', '제주시');">제주</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '전남', '여수시');">여수</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '충남', '태안군');">태안</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '강원', '양양군');">양양</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '경남', '거제시');">거제</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '경북', '경주시');">경주</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '강원', '강릉시');">강릉</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '강원', '평창군');">평창</div>
                            </div>




































                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->


  <section class="probootstrap_section" style="padding-top: 7rem;">
    <div class="container">
      <div class="row text-center mb-5 probootstrap-animate">
        <div class="col-md-12">
          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">모든 예약 집합소!</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '모텔', '0', '', '')">
            <img src="<?php echo e($s3); ?>/images/cate_01_motel_img.png" alt="모텔" class="img-fluid w-100" >
            <div class="probootstrap-text">
              
            </div>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '호텔', '1', '', '')">
            <img src="<?php echo e($s3); ?>/images/cate_02_hotel_img.png" alt="호텔" class="img-fluid w-100" >
            
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '펜션', '2', '', '')">
            <img src="<?php echo e($s3); ?>/images/cate_03_pension_img.png" alt="펜션" class="img-fluid w-100">
            
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '캠핑/글램핑', '3', '', '')">
            <img src="<?php echo e($s3); ?>/images/cate_04_glamping_img.png" alt="글램핑" class="img-fluid w-100">
            
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '공간대여', '4', '', '')">
            <img src="<?php echo e($s3); ?>/images/cate_05_space_img.png" alt="공간대여" class="img-fluid w-100">
            
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '모텔', '0', '', '')">
            <img src="<?php echo e($s3); ?>/images/cate_06_special_img.png" alt="" class="img-fluid w-100">
            
          </a>
        </div>
      </div>
    </div>
  </section>













































  <section class="probootstrap_section d-none d-lg-inline-block">
    <div class="container">
      <a data-toggle="modal" data-target="#event" style="cursor: pointer">


        <img src="<?php echo e($s3); ?>/images/banner_03_2.png" class="w-100">
      </a>
    </div>
  </section>


  <section class="probootstrap_section d-block d-lg-none">
    <div class="container-fluid p-0">
      <a data-toggle="modal" data-target="#event">


        <img src="<?php echo e($s3); ?>/images/banner_03_m.png" class="w-100" style="border-radius: 0 !important;">
      </a>
    </div>
  </section>

  
  
  
  
  
  
  
  
  


  
  
  
  
  
  
  
  
  
  
  
  


  
  
  
  
  
  
  
  
  
  
  
  
  

  <?php $__currentLoopData = $cate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <section class="probootstrap_section">
      <div class="container">
        <div class="row text-center mb-5 probootstrap-animate">
          <div class="col-md-12">
            <h2
              class="display-5 border-bottom probootstrap-section-heading mb-0"> <?php echo e($ca->community_category_name); ?></h2>
          </div>
        </div>

        <div class="row probootstrap-animate">
          <div class="col-md-12">
            <!-- Swiper -->
            <div class="swiper-container">
              <div class="swiper-wrapper">
                <?php $__currentLoopData = $contents[$ca->community_category_idx]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $con): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="swiper-slide">
                    <a href="<?php echo e($con->community_link); ?>" target="_blank">
                      <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">
                        <img src="<?php echo e($con->community_image_route . $con->community_image_save_name); ?>" height="100%"
                             alt="Free Template by uiCookies" class="img-fluid">
                      </div>
                      <div class="media-body new-media-body">
                        <p class="mb-0 text-white font-weight-bold"><?php echo e($con->community_name); ?></p>
                        <p class="font-80"><?php echo e($con->community_sido); ?> <?php echo e($con->community_sigungu); ?></p>
                      </div>
                    </a></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <!-- Add Arrows -->
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  


  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  


  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  



  <?php if(count($new_datas) > 0): ?>
  <section class="probootstrap_section">
    <div class="container">
      <div class="row text-center mb-5 probootstrap-animate">
        <div class="col-md-12">
          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">신규 공간 추천</h2>
        </div>
      </div>

      <div class="row probootstrap-animate">
        <div class="col-md-12">
          <!-- Swiper -->
          <div class="swiper-container">
            <div class="swiper-wrapper">
              <?php $__currentLoopData = $new_datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                  <a href="<?php echo e($new->community_link); ?>" target="_blank">
                    <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">
                      <img src="<?php echo e($new->community_image_route . $new->community_image_save_name); ?>" height="100%"
                           alt="Free Template by uiCookies" class="img-fluid">
                    </div>
                    <div class="media-body new-media-body">
                      <p class="mb-0 text-white font-weight-bold"><?php echo e($new->community_name); ?></p>
                      <p class="font-80"><?php echo e($new->community_sido); ?> <?php echo e($new->community_sigungu); ?></p>
                    </div>
                  </a></div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <!-- END section -->


  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  <!-- END section -->

  
  
  
  
  


  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  

  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  

  
  

  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  

  
  
  
  
  


  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  

  
  

  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  <!-- END section -->

  <div class="modal fade" id="event" tabindex="-1" role="dialog" aria-labelledby="event"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;
    right: 0;
    top: 10px;">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;    color: #fff;
    cursor: pointer;">×</span>
          </button>
          <img src="//cloudfront.mo-zip.co.kr/mo-zip/images/event-header_2.png" class="w-100">





        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="/js/swiper.min.js"></script>
  <script>
      function search(value) {
          if (!value) {
              $("#searchresult").html("      <div class=\"searchresultitem-title\">핫스팟</div>\n" +
                  "                          <div class=\"searchresultitem-items\">\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '경기', '가평군');\">가평</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '제주특별자치도', '서귀포시');\">서귀포</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '제주특별자치도', '제주시');\">제주</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '전남', '여수시');\">여수</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '충남', '태안군');\">태안</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '강원', '양양군');\">양양</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '경남', '거제시');\">거제</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '경북', '경주시');\">경주</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '강원', '강릉시');\">강릉</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '강원', '평창군');\">평창</div>\n" +
                  "                            </div>\n" +
                  "                          </div>");


              // $("#searchresult").html("      <div class=\"searchresultitem-title\">핫스팟</div>\n" +
              //     "                          <div class=\"searchresultitem-items\">\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '노원구');\">노원</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '성북구');\">수유</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '성동구');\">왕십리</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '광진구');\">건대</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '송파구');\">잠실</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '강남구');\">강남</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '강동구');\">천호</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '서대문구');\">신촌</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '중구');\">종로</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '관악구');\">신림</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '경기', '부천시');\">부천</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '인천', '부평시');\">인천</div>\n" +
              //     "                            </div>\n" +
              //     "                          </div>");
          } else {
              $.ajax({
                  url: '/search',
                  type: "get",
                  dataType: "json",
                  data: {
                      "query": value
                  },
              }).done(function (response) {
                  $("#searchresult").html(response.datas);
              });
          }
      }

      function goPostPage(url, type, idx, sido, sigungu) {
          sessionStorage.setItem('type', type);
          sessionStorage.setItem('idx', idx);
          sessionStorage.setItem('sido', sido);
          sessionStorage.setItem('sigungu', sigungu);

          // name이 paging인 태그
          var f = document.paging;

          // form 태그의 하위 태그 값 매개 변수로 대입
          f.url.value = url;
          f.type.value = type;
          f.idx.value = idx;
          f.sido.value = sido;
          f.sigungu.value = sigungu;

          // input태그의 값들을 전송하는 주소
          f.action = "/" + url;

          // 전송 방식 : post
          f.method = "post"
          f.submit();
      }

      function searchShow() {
          $("#search").show();
      }

      function searchHide() {
          setTimeout(function () {
              $("#search").hide();
          }, 500);
      }

      var swiper = new Swiper('.swiper-container', {
          navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
          },
          breakpoints: {
              0 :{
                  slidesPerView: 1.2,
                  spaceBetween: 10
              },
              // when window width is >= 320px
              600: {
                  slidesPerView: 1.2,
                  spaceBetween: 10
              },
              // when window width is >= 480px
              800: {
                  slidesPerView: 2.2,
                  spaceBetween: 10
              },
              // when window width is >= 640px
              1000: {
                  slidesPerView: 3.2,
                  spaceBetween: 10
              }
          },
          freeMode: true,
          pagination: {
              el: '.swiper-pagination',
              clickable: true,
          },
      });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isihyeon/Documents/GitHub/mo-zip/resources/views/index.blade.php ENDPATH**/ ?>