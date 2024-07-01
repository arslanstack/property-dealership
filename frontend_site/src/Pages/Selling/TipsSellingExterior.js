import React from 'react'
import PropertyExperts from '../PropertyExperts/PropertyExperts'
import { useNavigate } from 'react-router-dom'
const TipsSellingExterior = () => {
    const navigate = useNavigate()
    return (
        <>
            <main className="page-content text-start">

                <section className="section-full">
                    <div className="container">
                        <div className="row">
                            <div className="col-12">
                                <h1>Tips for increasing your home appeal EXTERIORS </h1>
                                <p />
                                <ol className="breadcrumb">
                                    <li> <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a> </li>
                                    <li className="active">Tips for increasing your home appeal EXTERIORS</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>

                <section className="section-lg">
                    <div className="container">
                        <div className="row justify-content-center ">
                            <div className="col-lg-6">
                                <div className="blog-post">
                                    <h2>In The Yard </h2>
                                    <hr />
                                    <p>
                                        Grab people’s attention by enhancing your yard and landscaping. If your house looks inviting and well-maintained from the street, people will imagine that it’s attractive on the inside, too.
                                    </p>
                                    <ul className='dottypes px-3' style={{ lineHeight: '2' }}>
                                        <li className='pb-2'>Prune bushes and hedges; trim trees. </li>
                                        <li className='pb-2'>Keep your lawn looking healthy and green by mowing it often, fertilizing it, and keeping it edged and trimmed. </li>
                                        <li className='pb-2'>Clean up and dispose of pet mess. </li>
                                        <li className='pb-2'>Weed your gardens; add fertilizer and mulch and plant colorful flowers.</li>
                                        <li className='pb-2'>In winter, keep your driveway and sidewalks shoveled, de-iced, and well-lit. </li>
                                        <li className='pb-2'> Stack firewood, clean out birdbaths, repair and paint fences</li>
                                    </ul>
                                </div>
                            </div>
                            <div className="col-lg-6">
                                <div className="blog-post">
                                    <h2>Curb Appeal The “Wow” factor</h2>
                                    <hr />
                                    <p>
                                        that first visual, high-impact impression your home makes on potential buyers — can turn a looker into a buyer. To determine your property’s curb appeal, drive through your neighborhood and note other properties; then approach your own house as if you were a potential buyer. How does it look? Does it “wow” you? Will its curb appeal attract buyers? Note what needs improving, such as trimming trees, planting shrubs, or painting gutters. Little things convey that you’ve cared for your home, and this is your opportunity to sell that important message to buyers who are shopping from the street, simply cruising neighborhoods looking for houses for sale. To get them through your door, do what you can to make your property look like someone’s dream home.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="row justify-content-center ">

                            <div className="col-lg-6">
                                <div className="blog-post">
                                    <h2>Paint/Stain</h2>
                                    <hr />
                                    <p>
                                        If it’s peeling or blistering and you can’t remember the last time you painted it, your house needs some attention. That also goes for stain that is significantly faded. A newly painted or stained exterior will help sell your house faster, and whet
                                    </p>
                                </div>
                            </div>
                            <div className="col-lg-6">
                                <div className="blog-post">
                                    <h2>The Front Door </h2>
                                    <hr />
                                    <p>
                                        An attractive entry catches a buyer’s eye and says, “Welcome,” so highlight this area of your house with decorative touches, such as a wreath on the door or new shrubs and flowers around the steps. For an even grander entry, clean and paint your front door, or replace it with a new one for a few hundred dollars. Don’t forget to fix and polish doorknobs, repair torn screens, and then put out that new welcome mat.
                                    </p>
                                </div>
                            </div>
                        </div>


                    </div>
                </section>
                <PropertyExperts />
            </main>

        </>
    )
}

export default TipsSellingExterior
