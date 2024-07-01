import React from 'react'
import { useNavigate } from 'react-router-dom'
const SurvivngSale = () => {
    const navigate = useNavigate()
    return (
        <>
            <main className="page-content text-start">
                {/* Section Title Breadcrumbs*/}
                <section className="section-full">
                    <div className="container">
                        <div className="row">
                            <div className="col-12">
                                <h1>Surviving the Sale</h1>
                                <p />
                                <ol className="breadcrumb">
                                    <li>
                                        <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a>
                                    </li>

                                    <li className="active">Surviving the Sale</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                {/*Section Left Sidebar*/}
                <section className="section-lg">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-12 col-md-12 col-lg-8">
                                <h2 className='text-center' >
                                    The essentials when planning your home
                                </h2>
                                <h4 className='text-center' >The essentials when planning your home</h4>
                                <p className='text-center' >
                                    Selling a home can sometimes be a long, stressful, and costly process. Like anything, though, equipping yourself with the right tools and the right knowledge can eliminate a great number of the potential negative aspects of the process – and get you the maximum return on your investment.
                                </p>
                                <article className="thumbnail thumbnail-2 mt-5">
                                    <div className="img-wrap">
                                        <a className="h4 text-sushi mb-4 ">
                                            Your Team
                                        </a>
                                        <a className="img-block">
                                            <img
                                                src="/assets/images/surviving1.png"
                                                alt=""
                                                width={770}
                                                height={520}
                                            />
                                        </a>
                                    </div>
                                    <div className="caption">


                                        <p>
                                            The importance of having the right allies in the selling process cannot be overstated. Having an expert on your side, not only to assist you in making decisions and getting your home marketed, but also simply in terms of having an advocate in the process, is the single most important step you can take to reduce your stress.
                                        </p>
                                        <p>
                                            The first step in selling any home should be to arrange to get Comparative Market Analyses for your home from three different Realtors®. Many sellers take this step, but what they do with the information they receive is not always in their best interest.
                                        </p>
                                        <p>
                                            Once three CMAs have been prepared, the natural tendency is for a seller to hire the Realtor® who produces the highest number. This is often a mistake. Competing Realtors® sometime  inflate these numbers in order to ‘buy’ your listing, intending to later drop their price. If one CMA is significantly higher than the others, be suspicious of how that number was reached.
                                        </p>
                                        <p>
                                            More important to this process is getting an idea of these Realtors® backgrounds, expertise, motivation, and simply their personalities – you may be working closely with this representative for many weeks, so it is important that it be someone you trust.
                                        </p>
                                    </div>
                                </article>
                                <article className="thumbnail thumbnail-2">
                                    <div className="img-wrap">
                                        <a className="h4 text-sushi mb-4" >
                                            Your Goals
                                        </a>
                                        <a className="img-block">
                                            <img
                                                src="/assets/images/surviving2.png"
                                                alt=""
                                                width={770}
                                                height={520}
                                            />
                                        </a>
                                    </div>
                                    <div className='caption' >
                                        <p>
                                            <strong>Goal #1:</strong> Make lots of money. Most sellers fail to move beyond goal #1, and that can cause some problems. Another important goal that should be recognized is the attempt to minimize stress. Will getting an extra percentage or two for your home be worth the inconvenience of having it on the market for an extra month? Two months?
                                        </p>
                                        <p>
                                        Your priorities are your own, of course, but sometimes sellers underestimate the stress that having their home on the market for an extended period can generate. Constant showings, constant interruptions, and concerns about selling your home before buying its replacement are not minor concerns – each can have a major impact on your life. 
                                        </p>
                                        <p>
                                        Sit down and discuss just where you place the most importance in the selling process. If profit is your only priority, perhaps you can afford to be firmer in your asking price, and can reject offers that are less than ideal. Most sellers who have had their home on the market for an extended period of time, though, would agree that the few extra dollars were not worth it in the end.
                                        </p>
                                    </div>
                                </article>
                                <article className="thumbnail thumbnail-2">
                                    <div className="img-wrap">
                                    <a className="h4 text-sushi mb-4" >
                                    Your Trust 
                                        </a>
                                        <a className="img-block">
                                            <img
                                                src="/assets/images/surviving3.png"
                                                alt=""
                                                width={770}
                                                height={520}
                                            />
                                        </a>
                                    </div>
                                    <div className="caption">
                                       
                                      
                                        <p>
                                        The key to assembling a strong team is putting your trust in that team. 
                                        </p>
                                        <p>
                                        Few people would second-guess their heart surgeon and insist they could do a better job themselves, or question whether their lawyer’s knowledge of the law is more extensive than their own, but when it comes to selling a home, many homeowners find it difficult to put their faith in the knowledge of their Realtor® fully.
                                        </p>
                                        <p>
                                        For example, despite the fact that studies show that less than 1% of homes are sold through open houses, many homeowners insist their Realtor® hold one. Indeed, if a yard sign and an open house were all it took to sell a home, there wouldn’t be many Realtors® at all! 
                                        </p>
                                        <p>
                                        If you’ve put the right team in place, put your trust in that team. Realtors® have access to many highly advanced marketing strategies that you may not even realize are being utilized. 
                                        </p>
                                        <p>
                                        It is your Realtor’s® job to bring qualified buyers to the table – and keep in mind that he or she likely does not get paid at all if your house doesn’t sell! In most markets, the combination of the right representative and the right listing price will result in a sold home. If you recognize this early on, it becomes much easier to take a step back from the process, let your professional representative market your home, and minimize your stress. 
                                        </p>
                                        <p>
                                        Don’t hesitate to speak up if you think that things are not progressing as they should, but likewise, don’t hesitate to sit back and be comfortable in the knowledge that the sale of your home is being handled professionally and effectively
                                        </p>
                                    </div>
                                </article>
                              
                             
                            </div>

                        </div>
                    </div>
                </section>
            </main>

        </>
    )
}

export default SurvivngSale