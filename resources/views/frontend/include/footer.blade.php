@php

    $settings=App\Helpers\UserHelper::getHeaderFooter();

    $service=App\Helpers\UserHelper::service();

    $doctor=App\Helpers\UserHelper::doctorservice();
   $country=App\Helpers\UserHelper::country();


@endphp

<style>
    .country-code {
        color: #afa4a4;
        font-size: 14px;
        position: relative;
        z-index: 999;
        line-height: 42px;
        padding: 0px 6px;
    }
</style>

<footer>

    <div class="footer mt-2">

        <div class="container">

            <div class="row py-1 py-md-2 px-lg-0">

                <div class="col-lg-4 footer-col1">

                    <div class="row flex-column flex-md-row flex-lg-column">

                        <div class="col-md col-lg-auto"  style="padding: 0px">

                            <div class="footer-logo">

                                <?php

                                $str = $settings['footer-address'];

                                echo htmlspecialchars_decode($str);

                                ?>

                        </div>

                            <div class="mt-2 mt-lg-0"></div>



                        </div>





                        <div>

                            <div class="footer-text mt-1 mt-lg-2">

                                <p>To receive email releases, simply provide

                                    <br>us with your email below</p>

                                <div class="alert alert-danger print-error-msg" style="display:none">

                                    <ul></ul>

                                </div>

                                <form id="requestNewsletter" class="footer-subscribe">

                                  <div class="col" style="padding: 0px">

                                    <div class="input-group">

                                    <span><i class="icon-user"></i></span>

                                        <input name="name" type="text" class="form-control" placeholder="Your Name">



                                    </div>

                                    <!--<span id="error_name" style="display: none;">Field is required</span>-->

                                  </div>

                                  <div class="col" style="padding: 0px;">

                                    <div class="input-group mt-1">

                                        <span><i class="icon-black-envelope"></i></span>

                                        <input name="subscribe_mail" type="text" class="form-control" placeholder="Your Email" />

                                    </div>

                                    <!--<span id="error_subscribe_mail" style="display: none;">Field is required</span>-->

                                  </div>

                                    <div class="mt-2" style="width: 300px">

                                        <!--<button type="button" onclick="requestNewsletter();" class="btn btn-sm btn-hover-fill">Subscribe</button>-->
                                        <input class="btn btn-sm btn-hover-fill mt-15 " id="subcribtion" type="submit" name="submit" value="submit"/>

                                    </div>

                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                </form>

                            </div>



                        </div>

                    </div>

                </div>



            <div class="col-sm-6 col-lg-4">

                <h3>Quick Link</h3>

                <div class="h-decor"></div>

                <div class="footer-post d-flex">

                    <div class="footer-post-text">

                        <div class="footer-post-title"><a href="{{url('about')}}">About Us</a></div>

                    </div>

                </div>

                <div class="footer-post d-flex">

                    <div class="footer-post-text">

                        <div class="footer-post-title"><a href="{{url('services')}}">Offered Services</a></div>

                    </div>

                </div>

                <div class="footer-post d-flex">

                    <div class="footer-post-text">

                        <div class="footer-post-title"><a href="{{url('services')}}">Services Details</a></div>

                    </div>

                </div>

                <div class="footer-post d-flex">

                    <div class="footer-post-text">

                        <div class="footer-post-title"><a href="{{url('contact')}}">Contact Us</a></div>

                    </div>

                </div>

                <div class="footer-post d-flex">

                    <div class="footer-post-text">

                        <div class="footer-post-title"><a href="#" class="btn-link" data-toggle="modal" data-target="#modalDisclaimer">Disclaimer</a></div>

                    </div>

                </div>

            </div>



            <div class="col-sm-6 col-lg-4">

                <h3>Our Contacts</h3>

                <div class="h-decor"></div>

                <ul class="icn-list">

                    <li style="padding: 0px;">

                        <a href="{{url('contact')}}" class="btn btn-xs btn-gradient"><i class="icon-placeholder2"></i><span>Get directions on the map</span><i class="icon-right-arrow"></i></a>

                    </li>

                    <li><i class="icon-telephone"></i><b><span class="phone"><span class="text-nowrap">{{$settings['phone1']}}</span>, <span class="text-nowrap">{{$settings['phone2']}}</span></span></b></li>

                    <li><i class="icon-black-envelope"></i><a href="mailto:info@biopedclinic.net">{{$settings['email']}}</a></li>

                </ul>



                <div class="footer-social " style="margin-top: 20px">

                    <a href="http://www.facebook.com/sharer.php?u={{url()->current()}}" target="_blank" style="text-decoration:none">

                        <img src="http://image.noelshack.com/fichiers/2015/25/1434621881-iconmonstr-facebook-4-icon-32.png" alt="Facebook">

                    </a>

                    <a href="https://twitter.com/share?url={{url()->current()}}" target="_blank" style="text-decoration:none">

                        <img src="http://image.noelshack.com/fichiers/2015/25/1434621881-iconmonstr-twitter-4-icon-32.png" alt="Twitter">

                    </a>

                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->current()}}" target="_blank" style="text-decoration:none">

                        <img src="http://image.noelshack.com/fichiers/2015/25/1434621881-iconmonstr-linkedin-4-icon-32.png" alt="LinkedIn">

                    </a>



                </div>

            </div>

        </div>

    </div>

    <div class="footer-bottom">

        <div class="container">

            <div class="row text-center text-md-left">

                <div class="col-sm">Copyright © 2019 <a href="#">BioPedClinic</a></div>

                <div class="col-sm-auto ml-auto"><span class="d-none d-sm-inline">For emergency cases&nbsp;&nbsp;&nbsp;</span><i class="icon-telephone"></i>&nbsp;&nbsp;<b>{{$settings['phone1']}}</b></div>

            </div>

        </div>

    </div>

</div>

<!--//footer-->

    <div class="backToTop js-backToTop">

        <i class="icon icon-up-arrow"></i>

    </div>

<div class="modal modal-form modal-form-sm fade" id="modalQuestionForm">

    <div class="modal-dialog">

        <div class="modal-content">

            <button aria-label='Close' class='close' data-dismiss='modal'>

                <i class="icon-error"></i>

            </button>

            <div class="modal-body">

                <div class="modal-form">

                    <h3>Ask a Question</h3>

                    <div class="alert alert-danger print-error-msg" style="display:none">

                        <ul></ul>

                    </div>

                    <form class="mt-15" id="questionForm">

                        <div class="successform">

                            <p>Your message was sent successfully!</p>

                        </div>

                        <div class="errorform">

                            <p>Something went wrong, try refreshing and submitting the form again.</p>

                        </div>

                        <div class="input-group">

								<span>

								<i class="icon-user"></i>

							</span>

                            <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Your Name*" value="{{isset($userSession['name'])?$userSession['name']:''}}" />

                        </div>



                        <div class="input-group">

								<span>

									<i class="icon-email2"></i>

								</span>

                            <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Your Email*" value="{{isset($userSession['email'])?$userSession['email']:''}}" />

                        </div>

                        <div class="input-group">

								<span>

									<i class="icon-smartphone"></i>

								</span>
                                <select name="questioncountry" id="questioncountry" class="form-control questioncountry">

                                    <option selected="selected" disabled="disabled">Select Country for phonecode</option>
                                    @foreach($country as $wks)

                                        <option value="{{$wks->id.'-'.$wks->phonecode}}">{{$wks->country}}</option>

                                    @endforeach
                                </select>
                        </div>




                            <div class="input-group">

                                <span class="country-code"></span>

                                <input type="text" id="phone" name="phone" class="form-control" autocomplete="off" placeholder="Your Phone" />



                            </div>






                        <textarea name="message" class="form-control" placeholder="Your comment*"></textarea>



                        <div class="text-right mt-2">


                           <!-- <button type="button" onclick="questionForm();" class="btn btn-sm btn-hover-fill">Ask Now</button>-->
                            <input class="btn btn-sm btn-hover-fill mt-15" type="submit" id="questionFormSubmit" name="submit" value="submit"/>
                        </div>

                        <input type="hidden"  name="_token" value="{{csrf_token()}}">

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>



<div class="modal modal-form fade" id="modalBookingForm">

    <div class="modal-dialog">

        <div class="modal-content">

            <button aria-label='Close' class='close' data-dismiss='modal'>

                <i class="icon-error"></i>

            </button>

            <div class="modal-body">

                <div class="modal-form">

                    <h3>Book an Appointment</h3>

                    <div class="alert alert-danger print-error-msg" style="display:none">

                        <ul></ul>

                    </div>

                    <form class="mt-15" id="bookingForm">

                        <div class="successform">

                            <p>Your message was sent successfully!</p>

                        </div>

                        <div class="errorform">

                            <p>Something went wrong, try refreshing and submitting the form again.</p>

                        </div>

                        <div class="input-group">

								<span>

								<i class="icon-user"></i>

							</span>

                            <input type="text" id="bookingname" name="bookingname" class="form-control" autocomplete="off" placeholder="Your Name*" value="{{isset($userSession['name'])?$userSession['name']:''}}"/>

                        </div>

                        <!--<span id="error_bookingname" style="display: none;"></span>-->



                        <div class="row row-xs-space mt-1">

                            <div class="col-sm-6">

                                <div class="input-group">

										<span>

											<i class="icon-email2"></i>

										</span>

                                    <input type="text" id="bookingemail" name="bookingemail" class="form-control" autocomplete="off" placeholder="Your Email*" value="{{isset($userSession['email'])?$userSession['email']:''}}"/>

                                </div>

                                <!--<span id="error_bookingemail" style="display: none;"></span>-->

                            </div>

                            <div class="col-sm-6 mt-1 mt-sm-0">

                                <div class="input-group">

										<span>

											<i class="icon-birthday"></i>

										</span>

                                    <!--<input type="text" id="bookingphone" name="bookingphone" class="form-control" autocomplete="off" placeholder="Your Phone*" />-->
                                    <input type="text" id="bookingage" name="bookingage" class="form-control" autocomplete="off" placeholder="Your age" />


                                </div>



                            </div>

                        </div>




                        <div class="row row-xs-space mt-1">

                            <div class="col-sm-6">

                                <div class="input-group">

										<span>

											<i class="icon-smartphone"></i>

										</span>

                                    <select name="bookingcountry" id="bookingcountry" class="form-control bookingcountry">

                                        <option selected="selected" disabled="disabled">Select Country*</option>
                                        @foreach($country as $wks)

                                            <option value="{{$wks->id.'-'.$wks->phonecode}}">{{$wks->country}}</option>

                                        @endforeach
                                    </select>

                                </div>



                            </div>

                            <div class="col-sm-6 mt-1 mt-sm-0">

                                <div class="input-group">

										<span class="country-code"></span>

                                    <input type="text" id="bookingphone" name="bookingphone" class="form-control" autocomplete="off" placeholder="Your Phone*" />



                                </div>



                            </div>

                        </div>

                        <div class="selectWrapper input-group mt-1">

								<span>

									<i class="icon-doctor"></i>


								</span>

                            @if(isset($service[0]->id))

                                <select name="bookingservice" id="bookingservice" class="form-control bookingservice">

                                    <option selected="selected" disabled="disabled">Select Service*</option>

                                    @foreach($service as $wks)

                                            <option value="{{$wks->id}}">{{$wks->title}}</option>

                                    @endforeach

                                </select>

                            @endif

                        </div>

                        <!--<span id="error_bookingservice" style="display: none;"></span>-->



                        <div class="selectWrapper input-group mt-1 doctor" style="display: none;">



                                <span>

                                    <i class="icon-doctor"></i>

                                </span>



                            <select name="doctor" class="form-control" id="doctor">





                            </select>

                        </div>



                        <div class="selectWrapper input-group mt-1 service_type" style="display: none;">

								<span>

									<i class="icon-doctor"></i>

								</span>

                            <select name="service_type" class="form-control" id="service_type">



                            </select>

                        </div>







                        <div class="input-group flex-nowrap mt-1">

								<span>

									<i class="icon-calendar2"></i>

								</span>

                            <div class="datepicker-wrap">

                                <input name="bookingdate"  type="text" class="form-control datetimepicker" id="bookingdatepicker" placeholder="date*" value="">



                            <!--<span id="error_bookingdate" style="display: none;"></span>-->

                            </div>

                        </div>

                        <div class="input-group flex-nowrap mt-1">

								<span>

									<i class="icon-clock"></i>

								</span>

                            <div class="datepicker-wrap">

                                <input name="bookingtime"  type="text" class="form-control timepicker" placeholder="Time*">



                            <!--<span id="error_bookingtime" style="display: none;"></span>-->

                            </div>

                        </div>



                        <textarea name="bookingmessage" class="form-control" placeholder="Your comment"></textarea>

                        @if(!isset($userSession['email']))
                            <div class="text-right mt-2">

                                <input class="btn btn-sm btn-hover-fill mt-15 " id="continue" type="button" name="Continue"  value="Continue"/>

                            </div>

                        @endif

                            <div class="input-group " id="otp" style="display: none;">

                                <span>

                                        <i class="icon-doctor"></i>

                                    </span>

                                <input type="text" id="" name="otp" class="form-control" autocomplete="off" placeholder="Your otp*" value="" >


                            </div>






                        <div class="text-right mt-2" id="submit"  @if(!isset($userSession['email']))style="display: none;" @endif>

                            <input class="btn btn-sm btn-hover-fill mt-15" type="button" id="bookingFormSubmit" name="submit" value="submit"/>


                        </div>

                        <input type="hidden"  name="_token" value="{{csrf_token()}}">

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>






    <div class="modal fade" id="modalDisclaimer">

        <div class="modal-dialog">

            <div class="modal-content">



                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">Disclaimer</h4>

                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>



                <!-- Modal body -->

                <div class="modal-body">

                    <p>People may benefit from HBOT as an adjunctive therapy alongside their conventional medical treatments. It is always recommended that clients consult their doctors if there is any medical problem before commencing HBOT.</p>

                    <p>We confirm that there is no intention implied or otherwise that HBOT is given so with the intention of it being a cure, diagnosis or as a preventative for any disease. Any references, studies or testimonials on this website and discussed at our clinic do not imply that similar results will occur when the same therapy is experienced by another.</p>

                </div>



                <!-- Modal footer -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>



            </div>

        </div>

    </div>

    <div class="modal fade" id="modalAntiAgeing">

        <div class="modal-dialog">

            <div class="modal-content">



                <!-- Modal Header -->

                <div class="modal-header" style="background: #007bff;">

                    <h4 class="modal-title" style="color: #fff">Anti Ageing</h4>

                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>

                <!-- Modal body -->

                <div class="modal-body" style="padding: 15px;
    height: 60vh;
    overflow: auto;">

                    <p><b>Anti-Aging Benefits of Hyperbaric Oxygen</b></p>
                        <p>It is no wonder the anti-aging industry is worth hundreds of billions of dollars with the myriad of popular creams, lotions, and supplements. But, there is one cutting edge treatment which it’s called Hyperbaric Oxygen Therapy (HBOT). HBOT has been proven effective in treating virtually any condition in which poor circulation plays a role including everything from traumatic brain injury to ADD/ADHD, but the latest buzz on HBOT pertains to anti-aging.</p>
                    <p> HBOT has been a growing choice of many top actors, actresses, and models, whose skin is constantly in the limelight. Have they found the secret to looking young? Depending on how you define aging, hyperbaric oxygen therapy may be the proverbial “fountain of youth.” HBOT promotes cell repair, age spots, saggy skin, wrinkles, poor collagen structure, and skin cell damage by increasing circulation to the most peripheral areas of the body, which is your skin. In a recent study, mice were exposed to UVB rays, known to prematurely age your skin, and when placed in oxygen chambers developed fewer wrinkles and showed fewer signs of tissue damage overall.</p>
                    <p><b> What is aging?</b></p>
                          <p> So, what is aging and how do you define it? Aging appears to be a genetically programmed event. Biologically, scientists have found that the chromosomes in our cells progressively shorten each time the cell divides. Eventually, the chromosomes can shorten no further and stop dividing.</p>
                    <p>When this happens, the cells become sleepy and die. If this were the sole determinant of the length of a human life, then we would all live about the same length of time, plus or minus some genetic variation. In fact, as we all know, people’s life spans can vary widely, and this wide variation is largely due to the cumulative insults that a person’s body experiences over the course of a lifetime.</p>
                    <p>Hyperbaric Oxygen Therapy (HBOT)</p>
                    <p>Hyperbaric oxygen therapy (HBOT) can play a significant role in helping people maintain their health and prevent the negative effects of aging.</p>
                    <p>Premature aging can result in a decreased quality of life and a shortened lifespan. It is caused by many factors, including the effects of environmental stresses and insults to the body. The most common and obvious ones are alcohol, tobacco and drugs, as these substances exert a tremendous aging effect due to the progressive chronic wounding of the body. Along with age also comes the increased risk of developing diseases such as dementia, heart disease, and arthritis.</p>
                    <p> Hyperbaric oxygen therapy can help to heal and repair damaged cells. HBOT can boost metabolism, and counteract low oxygen levels that lead to slow-moving cell activity and oxidative stress throughout the body. It also helps to grow new blood vessels in tissue promoting healthy body function. Research has shown that it can also help to improve the efficiency of hemoglobin in transporting oxygen around the body; improve blood flow by helping to keep cell membranes flexible; suppress inflammation; and detoxify and fight infection by destroying bacteria, viruses, parasites and fungi that thrive in low-oxygen environments.</p>
                    <p>In addition to the role of hyperbaric oxygen therapy in many medical conditions, HBOT is gaining widespread recognition for its success in improving a wide range of cosmetic concerns. Regular treatment is believed to increase skin elasticity and to stimulate collagen production. This can improve skin texture and reduce the appearance of fine lines, wrinkles and scars. Plastic surgeons often prescribe the therapy to enhance recovery from reconstructive surgery as increased oxygen leads to the creation of new blood vessels (angiogenesis) promoting healing and faster recovery times.</p>
                    <p>Hyperbaric Oxygen is commonly used by celebrities as part of a detox protocol to increase the amount of oxygen in the blood. Oxygen promotes general health and wellness, increases energy, boosts the immune system, helps with pain relief(such as swollen joints and muscle pain), stress and regulating sleep patterns.</p>
                    <p>It also improves mental function, helping with depression, anxiety, stress and concentration. It can be a helpful cure for jet lag and hangovers with its restorative, relaxing and rejuvenating effect.</p>
                    <p>Hyperbaric oxygen has been endorsed by the British Board of Anti-aging and Integrative Medicine for its ability to enhance beauty and for its anti-ageing properties. It stimulates the production of collagen, improves skin elasticity, eliminates toxins and can help repair damaged skin. It can also promote healthy hair growth and help with weight loss, cellulite, wrinkles, acne, eczema, psoriasis and rosacea.</p>
                    <p>Joseph Priestley, one of the first discoverers of oxygen, once said, “Who can tell but that, in time, this pure air may become a fashionable article in luxury.” It seems that as the world is developing and Joseph Priestley’s prediction about air is becoming a reality [4]. As the advancement of industrialization, the supply of fresh air is steadily decreasing, making good quality of air more and more of a luxury.</p>
                    <p>Due to the reigning desire in today’s society to maintain youthful appearance, development of minimally invasive dermatological procedures is progressing to rejuvenate aging face. Quite a few of these minimally invasive procedures have been effectively developed such as chemical peels, intradermal fillers, and botulinum toxins, but one not yet fully understood is HBOT . HBOT as a therapy for aesthetic means is a relatively new use so there have not been a great number of researches done specifically on usage of oxygen therapy on reduction of wrinkles. However, from the few that has been done, positive outcomes were achieved and the use of oxygen therapy for treatment of wrinkles seems an attractive option.</p>
                    <p>Receiving regular treatments of HBOT is thought to increase skin elasticity and stimulate collagen production, leading to reduction of wrinkles and fine lines and improvement in skin texture . Many dermatology clinics and even spas have utilized machines that deliver concentrated oxygen to the patient or client to treat age-related skin problems. Oxygen is used in skin care because it is thought that delivery of natural oxygen increases cell metabolism. The use of oxygen therapy as a process of skin rejuvenation and reduction of loss of elasticity leading to formation of lines and wrinkles are becoming increasingly widespread in skin care clinics because of increasing successful results of their usage due to developing technologies. However, scientific evidences for those claims are waiting to be provided.</p>
                    <p><b> Causes of wrinkle formation</b></p>
                    <p>Health of skin is related to whole body health because the skin not only acts as a physical barrier against infections from foreign materials, but also controls the immune system, and produces hormones and neurotransmitters. Wrinkles and aesthetic skin problems, like blemishes and acne scars, are caused by many factors such as aging, exposure to the environment, especially an overexposure to the sun, smoking, gender, and poor nutrition. Wrinkles caused through aging are an intrinsic factor-caused aging, or genetically programmed aging, that happens over time. This genetically programmed aging mainly causes a decrease production of fibroblast, collagen, and elastin, which results in skin wrinkling and elasticity loss. Smoking causes skin aging and wrinkles because tobacco inhibits production of collagen and increase MMP and elastosis production, which degrades matrix proteins important for skin elasticity. Gender wise, skin of women seems to receive more wrinkles than men due to perhaps the estrogen level in women. Estrogen has been found to increase collagen production and skin thickness so as women age with decrease estrogen production, wrinkles formation are more prominent in women than men.</p>
                    <p>As for dietary intake, increasing vitamin C and linoleic acid consumption is associated with slower aging skin, while increasing fat and carbohydrates consumption causes faster skin aging.</p>
                        <p>UV radiation causes wrinkles and skin damage, which are symptoms of cutaneous aging or photoaging. Photoaging is characterized by epidermal hyperplasia or atrophy, thickening of basement membrane and stratum corneum, loss of dermal papillae, unusual keratinocytes and melanocytes, degradation of extracellular matrix molecules such as damage to collagen fibers, excessive deposition of abnormal elastic fibers, and increase of glycosaminoglycans. Photoaging is also characterized by dryness, rough texture, abnormal pigmentation, thickening of epidermis, deep creases, and visible wrinkles. UV-B induces matrix metalloproteinases (MMPs), which degrades basement membrane and rearranges the extracellular matrix (ECM), and Type I Collagenase, which digest Type I collagen that is important for supporting the skin, are also causes of wrinkle formation. In addition, it has been found that UV radiation can cause cutaneous angiogenesis, the formation of new blood vessels from pre-existing vessels, that can lead to wrinkles formation by inducing the hypoxia inducible factor (HIF-1) and up-regulation of vascular endothelial growth factor (VEGF).<p>


                    <p><b> Conclusion</b></p>
                        <p>The use of HBOT in medicine has come a long way since its first main use to treat decompression sickness. Use of hyperbaric oxygen to reduce the visibility of wrinkles have shown to be promising and effective to a certain degree since this treatment is currently being used and is becoming more widespread in spas and dermatology clinics worldwide.

                    </p>


                </div>

                <!-- Modal footer -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>



            </div>

        </div>

    </div>

    <div class="modal fade" id="modalGeneralHealth">

        <div class="modal-dialog">

            <div class="modal-content">



                <!-- Modal Header -->

                <div class="modal-header" style="background: #007bff;">

                    <h4 class="modal-title" style="color: #fff">General Health</h4>

                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>

                <!-- Modal body -->

                <div class="modal-body" style="padding: 15px;
    height: 60vh;
    overflow: auto;">

                    <p><b>General Health:</b></p>
                    <p>Hyperbaric oxygen therapy (HBOT) is a natural way of maintaining general health and well-being as it promotes the release of stem cells from the bone marrow. This increase in the stem cell concentration in the body ensures healing and rejuvenation of organs and repair of bone, vascular and nervous tissue. This mechanism is also responsible for the shortened recovery time after surgery, injury or strenuous exercise.</p>
                    <p>Research shows that many illnesses connected with aging can be avoided or slowed down through optimal cell health. Studies show that oxygen levels in arterial blood in a 70 year old are 20% lower than in a 30-50 year old. Chronic lack of oxygen can cause progressive nerve cell death (seen in Alzheimer’s Disease).</p>
                    <p>Dr. Paul Harch, in his book entitled “The Oxygen Revolution” argues that <b>hyperbaric oxygen therapy</b> will likely become the fountain of youth by the baby boomer generation whose life has been compromised by years of drug experimentation in the 1960s and 1970s. Dr. Harch says, “<b>Hyperbaric oxygen therapy</b> will be able to restore waning brain function and prevent premature dementia”.</p>
                    <p>Adding extra oxygen fights chronic conditions, especially inflammation and is very important in improving brain circulation and brain activity. On a longer scale, hyperbaric oxygen therapy provides neuroprotection by stimulating oxidative cerebral energy metabolism</p>
                    <p><b>Wellness:</b></p>
                    <p><b>Hyperbaric oxygen therapy</b> optimizes the white blood cells’ killing capacity, boosting the body’s immune system and improves blood circulation in all other organs, promoting detoxification and rejuvenation. Oxygen promotes bone mineralization and increases bone density. Additional oxygen initiates regeneration of damaged nerves due to age or injury giving a general relief of pain, swelling, cramps and numbness. <b>Hyperbaric oxygen therapy</b> bolsters the growth of new blood vessels in tissues promoting healthy bodily functions and greatly boosts the body’s metabolism making one feel energetic and invigorated. Inadequate oxygen level will cause cell death and organ malfunction which is aggravated by age, injury and illnesses. Adequate oxygen levels in your body will keep you in balance.</p>
                    <p><b> Detoxification:</b></p>
                    <p>Today’s hectic and stressful lifestyles with environmental pollutants, pesticides, fast-food diets and reduced activity has lowered our immune system and our body can easily be struggling hard to maintain an acceptable flow of oxygen. Reduced oxygen content slows down the exchange of the nutrients and metabolic byproducts which can accumulate and become toxic. Red blood cells instantly bind extra oxygen and the rest dissolves directly into the blood plasma, building up tissue oxygen levels far above normal in just a few minutes.  A higher (>20 times than normal) partial pressure of oxygen in the tissue will effectively drive out the toxins and heavy metals.</p>


                       <p><b> Benefits of Hyperbaric Oxygen Therapy:</b></p>
                    <p>•	Revitalizes by improving oxygenation of all organs</p>
                    <p>•Organ function is improved with more effective blood flow and removal of toxins</p>
                    <p>•	Regenerates small blood vessels (capillaries), nerves and bones</p>
                    <p>•	Rejuvenates by releasing stems cells from the bone marrow for tissue repair</p>
                    <p>•	Reduces pain, swelling, tingling, cramps and numbness.</p>
                    <p>•	Suppresses inflammation and infection</p>
                    <p>•	Shortens recovery time after injury/trauma, surgery or extreme exercise</p>
                    <p>•	Boosts metabolism and energy</p>


                </div>

                <!-- Modal footer -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>



            </div>

        </div>

    </div>

    <div class="modal fade" id="modalSportsInjuries">

        <div class="modal-dialog">

            <div class="modal-content">



                <!-- Modal Header -->

                <div class="modal-header" style="background: #007bff;">

                    <h4 class="modal-title" style="color: #fff">Sports Injuries</h4>

                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>

                <!-- Modal body -->

                <div class="modal-body" style="padding: 15px;
    height: 60vh;
    overflow: auto;">

                    <p>How does Hyperbaric Oxygen Therapy (HBOT) help to heal sports injuries?</p>
                    <p><b>Sports Injuries</b></p>
                    <p>Hyperbaric oxygen therapy may help athletes at all skill levels heal more quickly and get back to their favorite pursuit. Many sports injuries involve strains and sprains, which naturally cause swelling and edema (accumulation of excess fluid in connective tissue). These natural reactions to injury compress blood vessels and restrict the vital flow of oxygen-carrying plasma and red blood cells to the injury site. Cells and tissues surrounding the injury site become starved for oxygen, which impedes healing. In extreme cases, cell and tissue death can occur. HBOT may promote faster healing in common sports injuries such as:</p>
                    <p>High Ankle Sprains</p>
                    <p> Fractures</p>
                    <p>Pulled Muscles</p>
                    <p>Achilles Tendinitis</p>
                    <p>In the last decade, Hyperbaric Oxygen Therapy (HBOT) has been promoted in scientific literature or complementary therapy for sports injuries. Every week, increasing numbers of elite sports stars are using HBOT to boost their endurance and accelerate their recovery from musculoskeletal injury, ligament and cartilage damage — even bone fractures.</p>
                    <p>Here at Bioped Clinic Newtown Kolkata, we can help patients from a wide range of sporting backgrounds, including professional footballers, jockeys, athletes and cricketers to recuperate from injuries and get back out on the pitch as quick as possible.</p>
                       <p><b> The power of oxygen for sports</b>
                    <p> With Hyperbaric Oxygen Therapy at our clinic, you’re breathing in pure oxygen in a private, purpose-built brand new Hyperbaric chamber at up to 2 times the normal atmospheric pressure which increases the oxygen-carrying capacity of your blood and allows your body to absorb 10-15 times more oxygen than normal.</p>

                    <img src="{{URL::asset('public/assets/frontend/images/content/images.jpg')}}" class="img-responsive" style="width: 400px; height: 264px;">

                    <p><b>HBOT helps sports professionals recover</b></p>
                    <p> Many eminent sports stars are openly using HBOT as a way for healing injuries and boosting their performance. <b>Cristiano Ronaldo of Real Madrid</b> tore his hamstring and, despite a normal recovery time of 3-4 weeks, returned to play in 9 days because of HBOT. And after only 5 sessions of HBOT, endurance runner <b>Ellan Laquaniello</b> improved her performance by 35%.</p>
                    <p>Novak Djokovic, Terrell Owens, Darren Sharper, and Tim Tebow. All of these sports personalities have something in common other than being the best of their game. These distinguished sportsmen have used hyperbaric chamber time and again either to gain active recovery or to treat sports-related wounds such as muscle strain, ligament tear, TBI, and concussions.</p>
                    <p>Whether you are a minor league sportsman or a professional, injuries are an inevitable part of every sportsperson’s life. Professional and recreational sportspersons can get these injuries while playing on the field or during day-to-day training. Therefore, to recover in time and start playing again, athletes will have to take care of themselves, both physically and mentally.</p>
                    <p><b>Hyperbaric Therapy for Athletes: A Way of Active Recovery</b></p>
                    <p>In Hyperbaric Oxygen Therapy, the patient is put in a hyperbaric chamber where he/she breathes in 100 percent pure oxygen under an air pressure slightly higher than the normal sea level air pressure. Researchers have found that the healing process of sports-related injuries follows a consistent and natural path and takes place in three stages — inflammatory, proliferative, and remodeling. Oxygen plays an important role in the healing of the wounds and is a common element in all of the three stages.</p>
                    <p>Hyperbaric Chamber Success Stories for treating Sports Wounds</p>
                    <p><b>Terrel Owens uses Hyperbaric Chamber to return to Super Bowls:</b></p>
                    <p>Back in 2004 doctors had declared Terrel Owens unfit to play against the Patriots in the Super Bowl XXXIX owing to his broken leg and critical ligament injury in the right ankle. However, within 7 weeks of his injury, the former NFL wide receiver surprised and shocked the world by playing 62 out of 72 offensive snaps in the Super Bowl game and caught a total of nine passes for the 122 yards.</p>
                    <p>Owens admitted to using hyperbaric chamber as a part of his treatment and recovery process before returning to play for the Philadelphia Eagle. A 2011 study stated that HBOT had positive effects on injuries involving muscles, bones, and ligaments. Since his astonishing return to the game more than a decade ago, Owens’s performance was hailed as one of the most courageous in the history of Super Bowl.</p>
                    <p><b>Novak Djokovic uses Hyperbaric Chamber for Active Recovery:</b></p>
                    <p> Tennis star Novak Djokovic admitted in 2017 of using hyperbaric chamber for active recovery and to gain an edge on the field. Djokovic, the winner of 12 single grand slams, said that he uses the hyperbaric chamber to recover from the exhaustion of long-drawn tennis matches. “I think this (chamber)really helped. Not for the muscles, but more for recovering after an exhausting match. It is like a spaceship, a very interesting technology”, said Djokovic when asked about this unconventional treatment modality.</p>
                    <p>Djokovic also said that he tries to use the hyperbaric chamber whenever possible but unfortunately does not have access to it everywhere he goes. The tennis superstar admits that the chamber has benefited him immensely and says that many top ranking players in the world resort to this treatment for active recovery and injury healing capabilities.</p>
                    <p><b>Hyperbaric Chamber Aids Michael Phelps Recover From Training:</b></p>
                    <p> As stated above, the hyperbaric chamber is not always used as a treatment modality. It can also be utilized to boost the body’s recovery process from regular, intensive training. World-renowned swimmer Michael Phelps used the chamber to recover faster from his intensive day-to-day training. Phelps admitted that with growing age the recovery process of the body slows down, which is why he resorted to using the hyperbaric chamber to fasten up the process. The 16-time Olympic medalist states that the experience was “strange” but “good” and helps him to bounce back to the game faster.</p>
                    <p><b>Bill Romanowski used Hyperbaric Chamber for Concussions:</b></p>
                    <p>During his long career of 16 years with the National Football League (NFL) Bill Romanowski had suffered at least 20 concussions, which ultimately lead him to retire from professional football. In a 2009 interview, Romanowski spoke openly about his injuries and the impact it had on his life. The now retired player states that in the last couple of years of his professional football career he would often forget things, which are right in front of him, or slurred and mixed up words while talking.</p>
                    <p>“I would look for my car keys around the house and the keys were in my hand the whole time. I slurred my words; I was mixing words up. I would listen to my all-time favorite song on the radio and not remember who sang it,” said Romanowski.</p>
                    <p>However, Romanowski’s health condition improved significantly after he started using a hyperbaric chamber. Since his retirement, Romanowski vouches for hyperbaric oxygen therapy and has recommended it other NFL players battling with head injuries and concussions.</p>
                    <p><b>Final Takeaway:</b></p>
                        <p>Hyperbaric Chamber is widely used by athletes to treat sports-related injuries and has become a novel way to recover actively from the exhaustive daily training and games. However, before starting the hyperbaric oxygen therapy an athlete must always consult a medical professional to get to know the treatment better and to determine how long or many sessions he/she must undertake for recovery and treatment.

                    </p>


                </div>

                <!-- Modal footer -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>



            </div>

        </div>

    </div>




</footer>

<!-- Vendors -->

<script src="{{URL::asset('public/assets/frontend/vendor/jquery/jquery-3.2.1.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/jquery-migrate/jquery-migrate-3.0.1.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/cookie/jquery.cookie.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/moment.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/popper/popper.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/bootstrap/bootstrap.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/waypoints/jquery.waypoints.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/waypoints/sticky.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/slick/slick.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/scroll-with-ease/jquery.scroll-with-ease.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/countTo/jquery.countTo.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/form-validation/jquery.form.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/form-validation/jquery.validate.min.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/validatejs/jquery.validate.js')}}"></script>


<!-- Custom Scripts -->

<script src="{{URL::asset('public/assets/frontend/js/app.js')}}"></script>



<script src="{{URL::asset('public/assets/frontend/form/forms.js')}}"></script>



<script type="text/javascript">

    function requestForm() {

        var  requestname = $("[name='requestname']").val();

        var  requestemail = $("[name='requestemail']").val();

        var  requestphone = $("[name='requestphone']").val();

        var  requestservice = $("[name='requestservice']").val();

        var  requestdate = $("[name='requestdate']").val();

        var  requesttime = $("[name='requesttime']").val();

        var  error=0;



        if(requestname == ""){

            $('#error_requestname').show();

            error++;

        }

        else{

            $('#error_requestname').hide();

        }



        if(requestemail == ""){

            $('#error_requestemail').show();

            error++;

        }

        else{

            $('#error_requestemail').hide();

        }

        if(requestphone == ""){

            $('#error_requestphone').show();

            error++;

        }

        else{

            $('#error_requestphone').hide();

        }

        if(requestservice == ""){

            $('#error_requestservice').show();

            error++;

        }

        else{

            $('#error_requestservice').hide();

        }

        if(requestdate == ""){

            $('#error_requestdate').show();

            error++;

        }

        else{

            $('#error_requestdate').hide();

        }

        if(requesttime == ""){

            $('#error_requesttime').show();

            error++;

        }

        else{

            $('#error_requesttime').hide();

        }

        if(error==0){

            $.ajax({

                type: "POST",

                url: "{{url('request-add')}}",

                data: $("#requestForm").serialize(),

                success: function (data) {

                    if ($.isEmptyObject(data.error)) {

                        $("[name='requestname']").val('');

                        $("[name='requestemail']").val('');

                        $("[name='requestphone']").val('');

                        $("[name='requestservice']").val('');

                        $("[name='requestdate']").val('');

                        $("[name='requesttime']").val('');

                        alert('Your message was sent successfully!');



                    } else {

                        printErrorMsg('error');

                    }

                }

            });

        }

    }



</script>



<script type="text/javascript">

    $(document).ready(function () {
        // validate signup form on keyup and submit
        $("#bookingForm").validate({
            rules: {
                bookingname: {

                    required: true,

                },
                bookingphone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                bookingage: {
                    required: true,
                    number: true,


                },
                bookingemail: {
                    required: true,
                    regex:"[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}",
                },
                bookingservice: {
                    required: true,

                },
                bookingdate: {
                    required: true,

                },
                bookingtime: {
                    required: true,

                },
                bookingcountry: {

                    required: true,

                },
                otp: {

                    required: true,

                },

            },
            messages: {

                bookingname: {
                    required: "Please enter a name",

                },
                bookingphone: {
                    required: "Please provide a phone number",
                    number: "Must be number",
                    minlength: "Your phone number must be at least 10 characters long",
                    maxlength: "Your phone number only 10 characters long"
                },
                bookingage: {
                    required: "Please provide your age",
                    number: "Must be Desimal number",
                },
                bookingservice: {
                    required: "Please provide your service",

                },
                bookingemail: {
                    required: "Please enter a valid email address",
                    regex: "Please enter a valid email address",
                },
                bookingdate: {
                    required: "Please enter a date",

                },

                bookingtime: {
                    required: "Please enter a time",

                },
                bookingcountry: {
                    required: "Please enter a country",

                },
                otp: {
                    required: "Otp send in Your Mail.",

                },
            }
        });
    });

    $(".bookingcountry").change(function(){
        var countryCode=$(this).val();
        var res = countryCode.split("-");
        $(".country-code").html('+'+res[1]);
    });

    $('#bookingFormSubmit').click(function(){
        if($("#bookingForm").valid()){

            $.ajax({
                url:"{{url('booking-add')}}",
                type:"POST",
                data: $("#bookingForm").serialize(),
                success: function(data){
                    alert(data);
                    alert('Successfully submited');
                    $('#bookingForm').get(0).reset();
                    $('#modalBookingForm').modal('hide');
                },
                error: function(data){
                    alert('error'+data);
                }
            });
        }
    });

    $('#continue').click(function(){

        if($("#bookingemail").valid()){
            var bookingemail=$("#bookingemail").val();
            //alert('ok');
            $.ajax({
                url:"{{url('booking-otp')}}",
                type:"POST",
                data:{'bookingemail':bookingemail,'_token':'{{csrf_token()}}'} ,

                success: function(data){
                    if (data == 'Success') {
                        $("#continue").hide();
                        $("#otp").show();
                        $("#submit").show();

                    }
                   // $('#bookingForm').get(0).reset();
                   // $('#modalBookingForm').modal('hide');
                }
            });
        }
    });

</script>


<script type="text/javascript">
    $(".questioncountry").change(function(){
        var countryCode=$(this).val();
        var res = countryCode.split("-");
        $(".country-code").html('+'+res[1]);
    });


    $('#questionFormSubmit').click(function(){
        //$().ready(function() {
        // validate signup form on keyup and submit
        $("#questionForm").validate({
            rules: {
                name: {

                    required: true,

                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },

               email: {
                    required: true,
                    regex:"[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}",
                },
               message:{
                   required: true,
               },
                questioncountry: {

                    required: true,

                },


            },
            messages: {

                name: {
                    required: "Please enter a name",

                },
               phone: {
                   required: "Please enter a number",
                    number: "Must be number",
                    minlength: "Your phone number must be at least 10 characters long",
                    maxlength: "Your phone number only 10 characters long"
                },

                email: {
                    required: "Please enter a valid email address",
                    regex: "Please enter a valid email address",
                },
                questioncountry: {
                    required: "Please select country",

                },
                message: {
                    required: "Please enter your comments",

                },

            },

            submitHandler: function(form) {

                $(form).ajaxSubmit({
                    url:"{{url('askquetion-add')}}",
                    type:"POST",
                    success: function(){
                        alert('Successfully submited');
                        $('#questionForm').get(0).reset();
                        $('#modalQuestionForm').modal('hide');

                    }
                });
            }
        });

    });


</script>


<script type="text/javascript">


    $("#datepicker").datetimepicker({

        format: "YYYY-MM-DD"

    });



    /*doctor list*/

    $('.bookingservice').change(function(event) {





        var consulting = $(this).val();

        if(consulting==8){

            $.ajax({

                url: '{{ url("/service-associated-doctors") }}',

                type: 'POST',

                data: {'serviceID': consulting,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {

                    $('.doctor').show();

                    $('#doctor').html(response);

                    console.log("success");

                })

                .fail(function() {

                    console.log("error");

                })

                .always(function() {

                    console.log("complete");

                });

        }else{
            $('.doctor').hide();
            $('.service_type').hide();
        }






    });

    /*type of service*/



    $('.doctor').change(function(event) {



        $.ajax({

            url: '{{ url("/service-type") }}',

            type: 'POST',

            data: {'_token':'{{csrf_token()}}'},

        })

            .done(function(response) {

                $('.service_type').show();

                $('#service_type').html(response);

                console.log("success");

            })

            .fail(function() {

                console.log("error");

            })

            .always(function() {

                console.log("complete");

            });



    });





</script>



<script type="text/javascript">



    $("#bookingdatepicker").datetimepicker({

        format: "YYYY-MM-DD"

    });

</script>





<script type="text/javascript">
    $(".expertcountry").change(function(){
        var countryCode=$(this).val();
        var res = countryCode.split("-");
        $(".country-code").html('+'+res[1]);
    });






</script>





<script type="text/javascript">
    $(".contactcountry").change(function(){
        var countryCode=$(this).val();
        var res = countryCode.split("-");
        $(".country-code").html('+'+res[1]);
    });





</script>

<script type="text/javascript">
    $('#subcribtion').click(function(){
        //$().ready(function() {
        // validate signup form on keyup and submit
        $("#requestNewsletter").validate({
            rules: {
                name: {

                    required: true,

                },


                subscribe_mail: {
                    required: true,
                    regex:"[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}",
                },



            },
            messages: {

                name: {
                    required: "Please enter a name",

                },

                subscribe_mail: {
                    required: "Please enter a valid email address",
                    regex: "Please enter a valid email address",
                },

            },

            submitHandler: function(form) {

                $(form).ajaxSubmit({
                    url:"{{url('emil-add')}}",
                    type:"POST",
                    data:$("#requestNewsletter").serialize(),
                    success: function(data){
                        if (data=='Success') {

                            $("[name='name']").val('');

                            $("[name='subscribe_mail']").val('');

                            alert('Your subcribtion process is done successfully!');



                        } else if(data=='duplicate'){

                            alert('You have already subscribed.');

                        }else if(data=='failure'){

                            alert('Failed to subscribe, please try again.');

                        }

                        //alert('Successfully submited');
                        //$('#contactForm').get(0).reset();
                        // $('#modalQuestionForm').modal('hide');

                    }
                });
            }
        });

    });


</script>







