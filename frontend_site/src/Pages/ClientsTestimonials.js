import React, { useEffect, useRef, useState } from 'react';
import Masonry from 'masonry-layout';
import 'react-image-lightbox/style.css'; // This only needs to be imported once in your app
import Lightbox from 'react-image-lightbox';
import imagesLoaded from 'imagesloaded';
import PropertyExperts from './PropertyExperts/PropertyExperts';
import { GetRequest } from '../Services/Api';
import { GET_TESTIMONIALS_URL } from '../Utils/URLs';
import PreLoading from '../Components/PreLoading/PreLoading';
import { useNavigate } from 'react-router-dom'


const ClientsTestimonials = () => {
  
    const [loading,setLoading] = useState(true)
    const [testimonial,setTestimonial] = useState([])
    const navigate = useNavigate()
    useEffect(() => {
        window.scroll({
            top:0,
            behavior:"instant"
        })
        const GetData = async()=>{
            try{
                const res = await GetRequest(GET_TESTIMONIALS_URL)
                setTestimonial(res.data)
                setLoading(false)
            }catch(error){
                console.log(error)
                setLoading(false)
            }
        }
        GetData()
    }, []);

   


    return (
        <>
        {loading ? <PreLoading />:
            <main className="page-content text-start">
                <section className="section-full">
                    <div className="container">
                        <div className="row">
                            <div className="col-12">
                                <h1>Clients Testimonials</h1>
                                <p />
                                <ol className="breadcrumb">
                                    <li>  <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a> </li>
                                    <li className="active">Clients Testimonials</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                {/* <section className="section-md bg-gray-dark">
                    <div className="container text-center text-xl-start">
                        <h2>What do clients say about our services?</h2>
                        <h4>Forget the rest... Work with the BEST!</h4>
                        <hr />
                        <div className="row text-center flow-offset-9">
                            <div className="col-12 col-md-6 col-xl-3">
                                <div className="pricing-wrapper-mod-1 card_custom thumbnail-mod-1 bg-default">
                                    <div className="pricing-head">
                                        <span className='icon-custom fa-bell-o'></span>
                                        <h4 className="text-ubold">Service</h4>
                                    </div>
                                    <p>Clients enjoy working with us because...</p>
                                    <p>Well, we get them!</p>
                                    <p>We've been where you are. Buying or selling property in a foreign country is scary! </p>
                                    <p>So we go above and beyond to treat you the way we would like to be treated. </p>
                                </div>
                            </div>
                            <div className="col-12 col-md-6 col-xl-3">
                                <div className="pricing-wrapper-mod-1 card_custom thumbnail-mod-1 bg-default">
                                    <div className="pricing-head">
                                        <span className='icon-custom fa-wrench'></span>
                                        <h4 className="text-ubold">Solutions</h4>
                                    </div>
                                    <p>We value your time & understand Time = Money.</p>
                                    <p>This is why we surround ourselves with professionals in every aspect of our business to provide you much needed resources. </p>
                                    <p>They'll not only get the job done but will save you time, money & avoid aggravation in the process. </p>

                                </div>
                            </div>
                            <div className="col-12 col-md-6 col-xl-3">
                                <div className="pricing-wrapper-mod-1 card_custom thumbnail-mod-1 bg-default">
                                    <div className="pricing-head">
                                        <span className='icon-custom fa-money'></span>
                                        <h4 className="text-ubold">We Represent YOU! </h4>
                                    </div>
                                    <p>Looking out for your best interest at all times is what we do. </p>
                                    <p>We negotiate the best price & the best terms to ensure you are not only protected but are not leaving any money on the table. </p>
                                    <p><strong>GUARANTEED!</strong></p>
                                </div>
                            </div>
                            <div className="col-12 col-md-6 col-xl-3">
                                <div className="pricing-wrapper-mod-1 card_custom thumbnail-mod-1 bg-default">
                                    <div className="pricing-head">
                                        <span className='icon-custom fa-check-square-o'></span>
                                        <h4 className="text-ubold">Experience</h4>
                                    </div>
                                    <p>Hands down, we get the job <strong>DONE!</strong></p>
                                    <p>Almost, 10 years of knowledge & experience have given us the upper hand in ensuring we provide our clients with a seamless pleasurable experience.</p>
                                    <p>A "NO SURPRISE" approach to doing business is our method.</p>
                                    <p>This is why 70% of our business is generated by repeat clientele and referrals!</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </section> */}
                <section className="section-md">
                    <div className="container">
                        <h2>Testimonials</h2>
                        <hr />
                        <div className="row pt-2">
                            {testimonial.map((item)=>(
                            <div className="col-lg-12">
                                <div className="testimonial pb-1 pb-md-4">
                                    <p className='d-flex'>
                                        <span className='test-icon-custom fa-quote-left pe-2'></span>
                                        <p>
                                           {item.content}
                                        </p>
                                    </p>
                                    <span><strong className='testimonial-user'>{item.name}</strong></span>
                                </div>
                            </div>
                            ))}
                           
                        </div>
                    </div>
                </section>
                {/* <section className="section-sm">
                    <div className="container gallery">
                        <h2>Clients Photo Album</h2>
                        <hr />
                        <div className="grid" ref={gridRef}>
                            <div className="grid-sizer"></div>
                            {images.map((image, index) => (
                                <div className="grid-item" key={index} onClick={() => openLightbox(index)}>
                                    <img src={image.src} alt={image.caption} />
                                </div>
                            ))}
                        </div>
                        {isOpen && (
                            <Lightbox
                                mainSrc={images[photoIndex].src}
                                nextSrc={images[(photoIndex + 1) % images.length].src}
                                prevSrc={images[(photoIndex + images.length - 1) % images.length].src}
                                onCloseRequest={handleLightboxClose}
                                onMovePrevRequest={() => setPhotoIndex((photoIndex + images.length - 1) % images.length)}
                                onMoveNextRequest={() => setPhotoIndex((photoIndex + 1) % images.length)}
                                onImageLoad={handleImageLoad}
                                imageLoadErrorMessage="Failed to load image"
                                enableZoom={true}
                                reactModalStyle={{ overlay: { zIndex: 2000 } }}
                                imagePadding={50}
                                animationDisabled={false}
                                loading={isLoading}
                            />
                        )}
                    </div>
                </section> */}

                <PropertyExperts />
            </main>
            }
        </>
    )
}

export default ClientsTestimonials