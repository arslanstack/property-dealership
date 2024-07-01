import React from 'react'
import { useNavigate } from 'react-router-dom'
const RightSelling = () => {
    const navigate = useNavigate()
    return (
        <>
            <main className="page-content text-start">
                {/* Section Title Breadcrumbs*/}
                <section className="section-full">
                    <div className="container">
                        <div className="row">
                            <div className="col-12">
                                <h1>The Right Selling Price</h1>
                                <p />
                                <ol className="breadcrumb">
                                    <li>
                                        <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a>
                                    </li>

                                    <li className="active">The Right Selling Price</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                {/*Section Blog Post*/}
                <section className="section-lg">
                    <div className="container">
                        <div className="row justify-content-center ">
                            <div className="col-lg-8">
                                <div className="blog-post">
                                    <h2>
                                        Affects your bottom line
                                    </h2>
                                    <hr />


                                    <p>
                                        The Right selling price when you’re selling your home, the price you set is a critical factor in the return you’ll receive. That’s why you need a professional evaluation from an experienced Realtor®. This person can provide you with an honest assessment of your home, based on several factors, including:
                                    </p>
                                    <ul className='dottypes px-3' >
                                        <li>Market Conditions</li>
                                        <li>Condition of Your Home</li>
                                        <li>Repairs or Improvements</li>
                                        <li>Selling Timeframe</li>
                                    </ul>

                                    <img src="/assets/images/rightSelling1.png" alt="" width={770} height={520} />
                                    <p>
                                        In real estate terms, market value is the price at which a particular house, in its current condition,
                                        should sell within 30 to 90 days.
                                    </p>
                                    <p>
                                        If the price of your home is too high, this could cause several things:
                                    </p>
                                    <p>
                                        Limits buyers. Potential buyers may not view your home because it appears to be out of their buying range.<br />
                                        • Limits showings. Other salespeople may be more reluctant to view your home.<br />
                                        • Used as leverage. Other Realtors® may use this home to drive the sale of other homes that are better-priced.<br />
                                        • Extended stay on the market. When a home is on the market too long, it may be perceived as defective.<br />
                                        Buyers may wonder, “what’s wrong,” or “why hasn’t this sold?” <br />
                                        • Lower price. An overpriced home, still on the market beyond the average selling time, could lead to a lower
                                        selling price. To sell it, you will have to reduce the price – sometimes several times. In the end, you’ll probably
                                        get less than if it had been properly priced in the first place.<br />
                                        • Wasted time and energy. A bank appraisal is most often required to finance a home.
                                    </p>
                                    <p>
                                        Realtors® have known it for years – well-kept homes that are properly priced in the beginning
                                        always get you the fastest sale for the best price! And that’s why you need a professional to assist
                                        you in the selling of your home.
                                    </p>
                                    <p>
                                        Often, in a seller’s market, homes that are priced slightly below market value initially will sell for
                                        more, simply because of the extra interest they incite. This can be a risk, however, and when it
                                        comes to such a decision, an experienced, trusted Realtor® is your best ally.
                                    </p>
                                    {/* <div className="blog-post-footer">
                                        <h4 className="border-bottom">Share</h4>
                                        <div className="icon-group">
                                            <a className="icon icon-sm icon-social fa-facebook" href="#" />
                                            <a className="icon icon-sm icon-social fa-twitter" href="#" />
                                            <a
                                                className="icon icon-sm icon-social fa-google-plus"
                                                href="#"
                                            />
                                            <a className="icon icon-sm icon-social fa-linkedin" href="#" />
                                            <a className="icon icon-sm icon-social fa-instagram" href="#" />
                                        </div>
                                    </div> */}
                                   
                                </div>
                            </div>


                        </div>
                    </div>
                </section>
            </main>

        </>
    )
}

export default RightSelling