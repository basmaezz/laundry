<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="{{asset('assets/landingPage/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/landingPage/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Changa:wght@200&display=swap"
        rel="stylesheet"
    />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        jQuery(document).ready(function($){
            var more="images/more-ic.png";
            var less="images/less-ic.png";
            $(".questionAnswer").click(function(){

                if($(this).closest(".questionAnswer").find('.imgBtn').attr('src')==more){
                    $(this).addClass("answerActive");
                    $(this).closest(".questionAnswer").find('.imgBtn').attr('src','images/less-ic.png');
                    $(this).closest(".questionAnswer").find('.answer').removeAttr('hidden');
                }else{
                    $(this).removeClass("answerActive");
                    $(this).closest(".questionAnswer").find('.imgBtn').attr('src','images/more-ic.png');
                    $(this).closest(".questionAnswer").find('.answer').attr('hidden', 'hidden');
                }
            });
        });
    </script>

    <title>Laundry</title>
</head>
<body>
<div class="nav-wrapper">
    <ul class="nav" style="direction: rtl; float: left; margin-top: 40px">
        <li class="nav-item">
            <a href="" class="nav-link">الرئيسيه</a>
        </li>
        <li class="nav-item">
            <a href="#optionsSection" class="nav-link">المميزات</a>
        </li>
        <li class="nav-item">
            <a href="#applicationIfoSection" class="nav-link">عن التطبيق</a>
        </li>
        <li class="nav-item">
            <a href="#contactUsSection" class="nav-link">تواصل معنا</a>
        </li>
        <li class="nav-item">
            <a href="#questionsSection" class="nav-link">اسئله مكرره</a>
        </li>
        <li class="nav-item">
{{--            <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                <i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>--}}
             <a href="" class="nav-link">
              English              <i class="flag-icon flag-icon-us"></i>

            </a>
        </li>
    </ul>
    <div class="logo">
        <img src="{{asset('assets/landingPage/images/logo-home.png')}}" alt="" class="logoImage" />
    </div>

    <div class="logoContent">
        <div class="logoHeader">
            <h5>👋! مرحبا بك فى تطبيق لاندري </h5>
        </div>
        <div class="logoParagraph">
            <p>البحث عن مكان أمن لغسيل ملابسك أصبح أسهل مع تطبيق لاندرى</p>
        </div>
        <div class="storeBtns">
            <div class="playStoreBtn">
                <img src="{{asset('assets/landingPage/images/playstore-btn.png')}}" alt="" />
            </div>
            <div class="appStoreBtn">
                <img src="{{asset('assets/landingPage/images/appstore-btn.png')}}" alt="" />
            </div>
            <div class="evaluation">
                <div class="evaluationStar">
                    <ul class="evaluationStarItems">
                        <li class="evaluationStarItem">
                            <img src="{{asset('assets/landingPage/images/14-rating-resources-small-empty-star.png')}}" />
                        </li>
                        <li class="evaluationStarItem">
                            <img src="{{asset('assets/landingPage/images/14-rating-resources-small-half-star.png')}}" />
                        </li>
                        <li class="evaluationStarItem">
                            <img src="{{asset('assets/landingPage/images/14-rating-resources-small-filled-star.png')}}" />
                        </li>
                        <li class="evaluationStarItem">
                            <img src="{{asset('assets/landingPage/images/14-rating-resources-small-filled-star.png')}}" />
                        </li>
                        <li class="evaluationStarItem">
                            <img src="{{asset('assets/landingPage/images/14-rating-resources-small-filled-star.png')}}" />
                        </li>
                    </ul>
                </div>
                <div class="evaluteText">
                    <span class="evaluteNum">4.9/5</span>
                    <p>تقييم على المتجر</p>
                </div>
            </div>
        </div>
    </div>
    <div class="headerSideImg">
        <img src="{{asset('assets/landingPage/images/hero-small-img.png')}}" alt="" />
    </div>
</div>

<section class="options_section" id="optionsSection">
    <div class="container">
        <div class="options-header">
            <!-- <h4>شوف شنو يقدر يسوي لك تطبيقنا</h4> -->
        </div>
        <div class="options-paragraph">
            <p class="fs-1">اكتشف مميزات تطبيق لاندرى!</p>
        </div>

        <div class="row optionsSections">
            <div class="col imageIcon ">
                <img src="{{asset('assets/landingPage/images/discover-ic.png')}}"  onmouseover="hoverDiscover(this);" onmouseout="hoverOutDiscover(this)"/>

                <h5 class="optionsSectionsHeader">أكتشف</h5>
                <p>المغاسل القريبة منك من بين افضل مغاسل المملكة</p>
            </div>
            <div class="col">
                <img src="{{asset('assets/landingPage/images/basket-ic.png')}}" onmouseover="hoveBasket(this);" onmouseout="hoverOutBasket(this)"  />

                <h5 class="optionsSectionsHeader">أضف الي السلة</h5>
                <p>أضف ملابسك الي السلة واحنا نجيك</p>
            </div>
            <div class="col">
                <img src="{{asset('assets/landingPage/images/payment-ic.png')}}" onmouseover="hoverPayment(this);" onmouseout="hoverOutPayment(this)" />

                <h5 class="optionsSectionsHeader"> ادفع اونلاين</h5>
                <p>
                    ادفع اونلاين من خلال منصات الدفع الالكتروني بطريقة امنه
                </p>
            </div>
            <div class="col">
                <img src="{{asset('assets/landingPage/images/tracking-ic.png')}}" onmouseover="hoverTracking(this);" onmouseout="hoverOutTracking(this)" />

                <h5 class="optionsSectionsHeader">تتبع طلبك</h5>
                <p>
                    تابع كل خطوات طلبك واستلامه وتسليمه عن طريق التطبيق وتطلع عليها
                    بشكل دائم
                </p>
            </div>
            <div class="col">
                <img src="{{asset('assets/landingPage/images/received-ic.png')}}" onmouseover="hoverRecevied(this);" onmouseout="hoverOutRecevied(this)"  />

                <h5 class="optionsSectionsHeader">استلام الملابس</h5>
                <p>
                    أستلم ملابسك من المغسلة عن طريق التوصيل او استلمها من المغسلة
                    بنفسك بعد الانتهاء من غسيلها
                </p>
            </div>
        </div>
    </div>
</section>

<section class="applicationIfoSection" id="applicationIfoSection">
    <div class="container">
        <h5 class="appInfoHeader">خذ لمحة عن شكل تطبيق لاندري</h5>
        <div class="arrows">
            <img
                src="{{asset('assets/landingPage/images/actions-controls-previous-outline-32.png')}}"
                class="arrowNext"
            />
            <img
                src="{{asset('assets/landingPage/images/actions-controls-previous-outline-32.png')}}"
                class="arrowPrevious"
            />
        </div>
        <div class="row appIfoScreens">
            <div class="col">
                <img src="{{asset('assets/landingPage/images/home-scr.png')}}" alt="" />
            </div>
            <div class="col">
                <img src="{{asset('assets/landingPage/images/details-scr.png')}}" alt="" />
            </div>
            <div class="col">
                <img src="{{asset('assets/landingPage/images/basket-scr.png')}}" alt="" />
            </div>
            <div class="col">
                <img src="{{asset('assets/landingPage/images/sennt-scr.png')}}" alt="" />
            </div>
            <div class="col">
                <img src="{{asset('assets/landingPage/images/done-scr.png')}}" alt="" />
            </div>
        </div>
    </div>
</section>
<section class="applicationIfoSection" id="applicationIfoSection">
    <div class="container">
        <h5 class="partnerHeader">كن جزءًا من شبكة مغاسلنا في تطبيق لاندرى</h5>
        <div class="partnerParagraph">
            شارك في بناء تجربة مميزة للعملاء وزد من رضاهم وولائهم وتحقق أهدافك
            التجارية



        </div>
        <div class="partnerList">
            <ul class="partnerListItemsRight">
                <li>
                    <img src="{{asset('assets/landingPage/images/check-ic.png')}}" alt="" />
                    مجانا بدون اى مصاريف
                </li>
                <li>
                    <img src="{{asset('assets/landingPage/images/check-ic.png')}}" alt="" /> ميزة تنافسية عن المغاسل
                    الاخرى
                </li>
            </ul>
        </div>
        <ul class="partnerListItemsLeft">
            <li>
                <img src="{{asset('assets/landingPage/images/check-ic.png')}}" alt="" />
                زيادة قاعدة العملاء خاصتك
            </li>
            <li>
                <img src="{{asset('assets/landingPage/images/check-ic.png')}}" alt="" />
                بيانات وتحليلات لسلوك العملاء
            </li>
        </ul>
        <div class="contactLinks">
            <div class="contactWhatsApp">
                <a href="https://api.whatsapp.com/message/YIGMUXYQVM3KH1?autoload=1&app_absent=0">
                    <img src="{{asset('assets/landingPage/images/sendwhats-btn.png')}}"  onmouseover="hoversendwhats(this);" onmouseout="hoverOutsendwhats(this)" />
                </a>
            </div>
            <div class="contactEmail">
                <img src="{{asset('assets/landingPage/images/sendemail-btn.png')}}"  onmouseover="hoversendemail(this);" onmouseout="hoverOutsendemail(this)" />
            </div>
        </div>
    </div>
    <div class="middlePhoneImage">
        <img src="{{asset('assets/landingPage/images/middle-img.png')}}" alt="" />
    </div>
    </div>
</section>

<!-- <section class="customerSection" id="customerSection">
  <div class="container">
    <div class="customerHeader">
      <h5 class="customerHead">الكثير من العملاء</h5>
      <p class="customerParagraph">في المملكة يثقون بخدماتنا</p>
    </div>
    <div class="customerTxt">
      تطبيق لاندري هو تطبيق سعودي يقدم لك خدمة توصيل لافضل مغاسل المملكة بكل سهولة. خلك مرتاح و مندوبنا يوصل ملابسك للمغسلة ويرجعها لك اذا خلصت.
    </div>
    <div class="customerNumbers">
      <div class="row">
        <div class="col">
                 <div class="customerNum">294</div><br>
                <div class="customerCaption">مغسلة حول المملكة</div>
        </div>
        <div class="col">
                 <div class="customerNum">4964 </div><br>
                 <div class="customerCaption">مستخدم للتطبيق</div>
        </div>
         <div class="col">
                 <div class="customerNum">130</div><br>
      <div class="customerCaption">مندوب توصيل</div>
        </div>
        <div class="col">
                 <div class="customerNum">4.9</div><br>
      <div class="customerCaption">تقييم علي المتجر</div>
        </div>
        <div class="col">
                 <div class="customerNum">+ 5000</div><br>
      <div class="customerCaption">تنزيل من المتجر</div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="customerExpert">
  <div class="container">
    <div class="customerExpertHeader">
      <h3>اقرأ تجارب عملائنا وتأكد من جودة خدماتنا</h3>
    </div>
    <div class="rectangle">
    </div>
    <div class="arrows">
      <img
        src="images/actions-controls-previous-outline-32.png"
        class="arrowNext"
      />
      <img
        src="images/actions-controls-previous-outline-32.png"
        class="arrowPrevious"
      />
    </div>
    <div class="customerExpertRows">
          <div class="row">
            <div class="col-3">
              <div class="expertContentFirst">
                "وأحلى شيء. شكرًا لكم على هذه الخدمة المميزة."
              </div>
            </div>
            <div class="col-6">
              <div class="expertContentSecond">
                “"تطبيق المغاسل هذا غير حياتي تمامًا، ما عاد أحتاج أروح وأرجع من المغسلة، كلّ شيء يتم بالتطبيق وتوصلني الملابس لعندي. شكرًا على هذه الميزة الرهيبة! 👌بعد ما استخدمت تطبيق المغاسل، ما أقدر أتخيل حياتي بدونه. سهولة الاستخدام والخدمة الرائعة والتوصيل السريع كلها أشياء جعلتني أفضل من أستخدمه."
              </div>
              <div class="avatar">
                <img src="images/avatar.jpg" class="avatar" alt="">
              </div>
              <div class="userName">
                <p class="user">عبدالعزيز الباكر</p>
                <span class="userDesc">المدير التنفيذى</span>
              </div>
            </div>
            <div class="col-3">
              <div class="expertContentThird"></div>
            </div>
          </div>

    </div>
  </div>

</section> -->
<section class="laundryDelegate ">
    <div class="container">
        <div class="question">
            <h4 class="questionHead">ترغب في الانضمام كمندوب تطبيق لاندري؟</h4>
            <p>يمكنك التواصل معنا من خلال الرابط التالي لملئ نموذج التسجيل ومن ثم سيصلك التاكيد علي الطلب</p>
        </div>
        <div class="delegateBtn">
            انضم كمندوب الان
        </div>
        <div class="tShirtImg">
            <img src="images/banner-img.png" alt="">
        </div>
    </div>
</section>



<section class="commonQuestionsSection"  id="questionsSection">
    <div class="container overflow-hidden">
        <h4  class="questionSectionHead">اسئلة مكررة</h4>
        <p class="questionSectionContent">بعض الأسئلة التي تتكرر من عملاء تطبيق لاندري وزوار الموقع.</br>
            حال لم تجد السؤال الذي تبحث عنه يمكنك مراسلتنا عبر البريد الاليكتوني ادناه…</p>

        <div class="contactUsBtn">
            <h6>تواصل معنا</h6>
        </div>
        <div class="row g-2">
            <div class="col-6 questionAnswer ">
                <div class="p-3 " style="border:solid 1px #e0e0e0;border-radius: 12px;">
                    <div class="moreIcon5" id="moreBtn" fixed>
                        <img src="{{asset('assets/landingPage/images/more-ic.png')}}" class="imgBtn">
                    </div>
                    <div class="questionText">
                        <h6 class="questionTextHead ">كيف يعمل تطبيق لاندري؟ </h6>
                        <p class="answer " hidden >اختر مغسلة من بين افضل المغاسل الموجودة في منطقتك، اختر الخدمة والقطع التي تريدها، ادفع الكترونياً بطريقة آمنة ومندوب التوصيل بيجيك يستلم الملابس منك ويوديها للمغسلة. وبعد الانتهاء من الغسيل يمكنك اختيار توصيل أو تقدر تستلمها بنفسك. </p>
                    </div>

                </div>
            </div>
            <div class="col-6 questionAnswer imgBtn">
                <div class="p-3 " style="border:solid 1px #e0e0e0;border-radius: 12px;">
                    <div class="moreIconLeft" id="moreBtn">
                        <img src="{{asset('assets/landingPage/images/more-ic.png')}}" alt="" class="imgBtn">
                    </div>
                    <div class="questionText">
                        <h6  class="questionTextHead imgBtn">كيف يمكنني جدولة وقت استلام طلبي من المغسلة؟ </h6>
                        <p class="answer" style="margin-bottom: 39px;"  hidden>لا تحتاج لجدولة الاستلام، اطلب عملية التوصيل ويجيك مندوب التوصيل في الحال او اختر استلام الملابس بنفسك من المغسلة وروح استلمها في اوقات عمل المغسلة. </p>
                    </div>

                </div>
            </div>
            <div class="col-6 questionAnswer imgBtn">
                <div class="moreIconRight2" id="moreBtn">
                    <img src="{{asset('assets/landingPage/images/more-ic.png')}}" class="imgBtn">
                </div>
                <div class="p-3 " style="border:solid 1px #e0e0e0;border-radius: 12px;">
                    <h6 class="questionTextHead imgBtn">ما هو وقت الاستجابة لطلبات الغسيل التي تتم عبر التطبيق؟  </h6>
                    <p class="answer" hidden>وقت الاستجابة فوري في حال كان الطلب في اوقات عمل المغسلة.  </p>
                </div>

            </div>
            <div class="col-6 questionAnswer imgBtn">
                <div class="moreIconLeft2" id="moreBtn">
                    <img src="{{asset('assets/landingPage/images/more-ic.png')}}" class="imgBtn">
                </div>
                <div class="p-3 " style="border:solid 1px #e0e0e0;border-radius: 12px;">
                    <h6 class="questionTextHead imgBtn">هل يتوفر استلام وتوصيل لجميع الطلبات ام فقط بعضها؟ </h6>
                    <p class="answer"hidden>يتوفر توصيل لجميع الطلبات، نحن نتعامل مع المغاسل التي توفر خدمة التوصيل. </p>
                </div>

            </div>
            <div class="col-6 questionAnswer imgBtn">
                <div class="moreIconLeft2" id="moreBtn">
                    <img src="{{asset('assets/landingPage/images/more-ic.png')}}" class="imgBtn">
                </div>
                <div class="p-3 " style="border:solid 1px #e0e0e0;border-radius: 12px;">
                    <h6 class="questionTextHead imgBtn">ماهي انواع خدمات الغسيل التي يتم تقديمها؟  </h6>
                    <p class="answer" hidden>تطبيق لاندري يقدملك جميع الخدمات التي يتم تقديمها في المغسلة المختارة.   </p>
                </div>

            </div>
            <div class="col-6 questionAnswer imgBtn">
                <div class="moreIconLeft2" id="moreBtn">
                    <img src="{{asset('assets/landingPage/images/more-ic.png')}}" class="imgBtn">
                </div>
                <div class="p-3 " style="border:solid 1px #e0e0e0;border-radius: 12px;">
                    <h6 class="questionTextHead imgBtn">هل ادارة التطبيق متواجدة بالسعودية؟  </h6>
                    <p class="answer" hidden>نعم، وموقعنا في مدينة الخبر وخدمة العملاء متواجدين بالسعودية ايضاً.</p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="contactUsSection" id="contactUsSection">
    <div class="container">
        <div class="row ">
            <div class="col-5">
                <div class="logoFooter">
                    <img src="{{asset('assets/landingPage/images/logo-footer.png')}}" alt="">
                    <p class="paragraphFooter">ارسل ملابسك لافضل مغاسل المملكة وانت في بيتك</p>
                </div>

            </div>
            <div class="col-2">
                <div class="menuFooter">
                    <h5 class="mapSite">خريطة الموقع</h5>
                    <ul class="mapSiteItems">
                        <li>الرئيسية</li>
                        <li>المميزات</li>
                        <li>عن التطبيق</li>
                        <li>تواصل معنا</li>
                        <li>اسئلة مكررة</li>
                    </ul>
                </div>
            </div>
            <div class="col-5">
                <div class="contactFooter">
                    <h5 class="contactUsText">للتواصل معنا</h5>
                    <div class="mail">
                        Info@Laundry.com
                    </div>

                    <div class="followUs">
                        <h5 class="followUSText">تابعنا على</h5>
                    </div>
                    <div >
                        <ul class="followItems">
                            <li><a href="https://twitter.com/salaundry?s=11&t=r62cf25kOeQPSLcllF1FYA"><img src="{{asset('assets/landingPage/images/twitter-ic.png')}}" ></a></li>
                            <li><a href="https://www.instagram.com/laundry_app/?igshid=OGQ5ZDc2ODk2ZA%3D%3D"><img src="{{asset('assets/landingPage/images/insta-ic.png')}}" ></a> </li>
                            <li> <a href="https://www.linkedin.com/company/laundry-app/">   <img src="{{asset('assets/landingPage/images/in-ic.png')}}" ></a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footerBorderSection"></div>
    <div class="copyRights">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="copyRight">
                        جميع حقوق النشر © تطبيق لاندرى 2023
                    </div>
                </div>
                <div class="col-6 ">
                    <ul class="politics">
                        <li>سياسة الخصوصية</li>
                        <li class="conditions">الشروط والاحكام</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="{{asset('assets/landingPage/js/bootstrap.js')}}"></script>
<script>
    function hoverDiscover(img)
    {
        img.src = 'assets/landingPage/images/discover-on-ic.png'
    }
    function hoverOutDiscover(img)
    {
        img.src ='assets/landingPage/images/discover-ic.png'
    }
    function hoveBasket(img)
    {
        img.src='assets/landingPage/images/basket-on-ic.png'
    }
    function hoverOutBasket(img)
    {
        img.src='assets/landingPage/images/basket-ic.png'
    }
    function hoverPayment(img)
    {
        img.src='assets/landingPage/images/payment-on-ic.png'
    }
    function hoverOutPayment(img)
    {
        img.src='assets/landingPage/images/payment-ic.png'
    }
    function hoverTracking(img)
    {
        img.src='assets/landingPage/images/tracking-on-ic.png'
    }
    function hoverOutTracking(img)
    {
        img.src='assets/landingPage/images/tracking-ic.png'
    }
    function hoverRecevied(img)
    {
        img.src='assets/landingPage/images/received-on-ic.png'
    }
    function hoverOutRecevied(img)
    {
        img.src='assets/landingPage/images/received-ic.png'
    }

    function hoversendwhats(img){

        img.src='assets/landingPage/images/sendwhats-on-btn.png'
    }
    function hoverOutsendwhats(img){
        img.src='assets/landingPage/images/sendwhats-btn.png'
    }
    function hoversendemail(img){
        img.src='assets/landingPage/images/sendemail-on-btn.png'
    }
    function hoverOutsendemail(img){
        img.src='assets/landingPage/images/sendemail-btn.png'
    }
</script>
</body>
</html>
