import React from 'react'

const Footer = () => {
    return (
        <>
            <footer className="page-foot text-start bg-gray">
                <section className="footer-content">
                    <div className="container">
                        <div className="row flow-offset-3">
                            <div className="col-12 col-md-6 col-xl-4">
                                <div className="rd-navbar-brand">
                                    <a className="brand-name" href="/">
                                        <img src="/assets/images/logo-2.png" alt="" />
                                    </a>
                                </div>
                                <p className="text-gray">
                                    We are Ron & Aury, a dedicated team that brings years of experience and professionalism to each and every client we serve. We look forward to helping you become our neighbor and earning your trust and business.
                                </p>

                                
                            </div>
                            
                            <div className="col-12 col-md-6 col-xl-4 text-center">
                                <h6 className="text-ubold">We Can't Wait To Exceed Your Expectations!</h6>
                                <div className='d-flex flex-column justify-content-center align-items-center '>
                                    <img className='img-footer' src="https://mybajaproperty.com/wp-content/uploads/2023/11/ampi_logo-150x150.png" alt="AMPI logo" />
                                    <img className='img-footer' src="https://mybajaproperty.com/wp-content/uploads/2023/11/realtor_logo.jpg" alt="AMPI logo" />
                                </div>
                            </div>
                            <div className="col-12 col-md-6 col-xl-4">
                                <h6 className="text-ubold">Contact Us</h6>

                                <address className="address">
                                    {/* <dl>
                                        <dt>Headquarters:</dt>
                                        <dd>795 Folsom Ave, Suite 600 San Francisco, CA 94107</dd>
                                    </dl> */}
                                    <dl className="dl-horizontal-mod-1 d-flex">
                                        <dt><span class="icon icon-right icon-size_custom me-2 fa-whatsapp"></span></dt>
                                        <dd>
                                            <a className="text-primary" href="https://wa.me/13109265005">
                                                Ron: +1(310) 926-5005
                                            </a>
                                        </dd>
                                    </dl>
                                    <dl className="dl-horizontal-mod-1 d-flex">
                                        <dt><span class="icon icon-right icon-size_custom me-2 fa-whatsapp"></span></dt>
                                        <dd>
                                            <a className="text-primary" href="https://wa.me/13104679003">
                                                Aury: +1(310) 467-9003
                                            </a>
                                        </dd>
                                    </dl>


                                    <dl className="dl-horizontal-mod-1 d-flex">
                                        <dt><span class="icon icon-right icon-size_custom me-2 fa-envelope"></span></dt>
                                        <dd>
                                            <a className="text-primary" href="mailto:ramybajaproperty.com">
                                                ra@mybajaproperty.com
                                            </a>
                                        </dd>
                                    </dl>
                                </address>

                                {/* <form
                                    className="rd-mailform text-start subscribe"
                                    data-form-output="form-output-global"
                                    data-form-type="subscribe"
                                    method="post"
                                    action="bat/rd-mailform.php"
                                >
                                    <div className="form-wrap">
                                        <label className="form-label" htmlFor="email-sub" />
                                        <input
                                            className="form-input"
                                            id="email-sub"
                                            type="email"
                                            name="email"
                                            data-constraints="@Required @Email"
                                            placeholder="Enter e-mail"
                                        />
                                    </div>
                                    <button className="btn btn-sushi btn-sm">subscribe</button>
                                </form> */}
                            </div>
                        </div>
                    </div>
                </section>
                <section className="copyright">
                    <div className="container">
                        <div className="row row-30 justify-content-between">
                            <div className="col-md-auto">
                                <p>
                                    ©<span className="copyright-year">All Rights Reserved</span>
                                    <a href="/"> <strong className='text-white'>MyBajaProprty.com</strong> {new Date().getFullYear()} </a>
                                </p>
                            </div>
                            <div className="col-md-auto">
                                <ul className="list-inline">
                                    <li>
                                        <a className="fa-facebook" href="https://www.facebook.com/ronNaurybaja"  alt="" />
                                    </li>
                                    <li>
                                        <a className="fa-instagram" href="https://www.instagram.com/Ron_N_Aury/" alt="" />
                                    </li>
                                    <li>
                                        <a className="fa-youtube" href="https://www.youtube.com/watch?v=kcnBy2ACpU4&amp;list=PLR-iLi35L5xvIC_C2puE2taA9YYv71Ndj" alt="" />
                                    </li>
                                    <li>
                                        <a className="icon icon-size_custom ms-2 fa-tiktok" href="https://www.tiktok.com/@ron_n_aury" alt="tiktok" />
                                    </li>
                                    <li>
                                        <a className="fa-pinterest-p" href="https://www.pinterest.com.mx/Ron_N_Aury/" alt="" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                {/* Rd Mailform result field*/}
                <div className="rd-mailform-validate" />
            </footer>

        </>
    )
}

export default Footer