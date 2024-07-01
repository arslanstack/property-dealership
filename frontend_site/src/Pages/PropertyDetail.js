import React, { useEffect, useState } from 'react'
import "react-image-gallery/styles/css/image-gallery.css";
import ImageGallery from "react-image-gallery";
import { GET_PROPERTY_DETAIL_URL } from '../Utils/URLs';
import { GetRequest } from '../Services/Api';
import { useLocation,useNavigate } from 'react-router-dom';
import PreLoading from '../Components/PreLoading/PreLoading';
const PropertyDetail = () => {
    const { state } = useLocation()
    const navigate = useNavigate()
    const [loading, setLoading] = useState(true)
    const [detail, setDetail] = useState({})

    useEffect(() => {
        const GetDetail = async () => {
            try {

                const res = await GetRequest(`${GET_PROPERTY_DETAIL_URL}/${state.propertyId}`)
                console.log(res)
                setDetail(res.data)
                setLoading(false)
            } catch (error) {
                console.log(error)
            }
        }
        GetDetail()
        window.scrollTo({
            top:0,
            behavior:"instant"
        })
    }, [state])

    const images = detail?.gallery?.map((item) => ({ original: item, thumbnail: item }))
    const snakeToTitle = (str) => {
        return str.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
    };

    var Features = []


    if (Object.keys(detail).length !== 0) {
        Features = Object.keys(detail.features)
            .filter((key) => detail.features[key].length > 0)
            .map((key) => ({
                title: snakeToTitle(key),
                data: detail.features[key]
            }))
    }

  
    return (
        <>
            {loading ? <PreLoading /> :
                <main className="page-content text-start property-detail ">
                    {/* Section Title Breadcrumbs*/}
                    <section className="section-full" style={{ backgroundImage: `linear-gradient(rgba(43,54,60,0.6),rgba(43,54,60,0.6)), url(${detail.banner})` }} >
                        <div className="container">
                            <div className="row">
                                <div className="col-12">
                                    <h1>{detail.title}</h1>
                                    <p />
                                    <ol className="breadcrumb">
                                        <li>
                                        <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a>
                                        </li>

                                        <li className="active">Property Detail</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </section>
                    {/* Section Catalog Single Left*/}
                    <section className="bg-gray-dark section-md section-md-mod-1">
                        <div className="container">
                            <div className="row flow-offset-7">
                                <div className="col-12 col-md-6 col-lg-3">
                                    <p>Property Code</p>
                                    <p className='h5 text-regular' >{detail.code}</p>
                                </div>
                                <div className="col-12 col-md-6 col-lg-3">
                                    <p>Status</p>
                                    <a className="h5 text-sushi text-regular">
                                        {detail.listing_status}
                                    </a>
                                </div>
                                <div className="col-12 col-md-6 col-lg-3 col-xl-3">
                                    <p>Neighborhood</p>
                                    <p className="h5 text-regular">
                                        {detail.neighborhood.title}
                                    </p>
                                </div>
                                <div className="col-12 col-md-6 col-lg-3 col-xl-2 offset-xl-1">
                                    <p>Price</p>
                                    <p className="thumbnail-price h5">
                                        ${detail.price}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section className="section-md section-md-mod-2">
                        <div className="container">
                            <div className="row">
                                <div className="col-12 col-md-12 col-lg-8">
                                    {/* Slick Carousel*/}
                                    <ImageGallery items={images} showPlayButton={false} autoPlay={true} infinite={true} slideDuration={450} slideInterval={4000} />
                                    {/* <div
                                    className="slick-slider carousel-parent"
                                    data-arrows="true"
                                    data-loop="false"
                                    data-dots="false"
                                    data-swipe="true"
                                    data-sm-items={1}
                                    data-lightgallery="group"
                                    data-child="#child-carousel"
                                    data-for=".thumbnail-carousel"
                                >
                                    <a
                                        className="item"
                                        data-lightgallery="item"
                                        href="/assets/images/product-single-1_original.jpg"
                                    >
                                        <img
                                            src="/assets/images/product-single-1.jpg"
                                            alt=""
                                            width={770}
                                            height={513}
                                        />
                                    </a>
                                    <a
                                        className="item"
                                        data-lightgallery="item"
                                        href="/assets/images/product-single-2_original.jpg"
                                    >
                                        <img
                                            src="/assets/images/product-single-2.jpg"
                                            alt=""
                                            width={770}
                                            height={513}
                                        />
                                    </a>
                                    <a
                                        className="item"
                                        data-lightgallery="item"
                                        href="/assets/images/product-single-3_original.jpg"
                                    >
                                        <img
                                            src="/assets/images/product-single-3.jpg"
                                            alt=""
                                            width={770}
                                            height={513}
                                        />
                                    </a>
                                    <a
                                        className="item"
                                        data-lightgallery="item"
                                        href="/assets/images/product-single-4_original.jpg"
                                    >
                                        <img
                                            src="/assets/images/product-single-4.jpg"
                                            alt=""
                                            width={770}
                                            height={513}
                                        />
                                    </a>
                                    <a
                                        className="item"
                                        data-lightgallery="item"
                                        href="/assets/images/product-single-5_original.jpg"
                                    >
                                        <img
                                            src="/assets/images/product-single-5.jpg"
                                            alt=""
                                            width={770}
                                            height={513}
                                        />
                                    </a>
                                    <a
                                        className="item"
                                        data-lightgallery="item"
                                        href="/assets/images/product-single-6_original.jpg"
                                    >
                                        <img
                                            src="/assets/images/product-single-6.jpg"
                                            alt=""
                                            width={770}
                                            height={513}
                                        />
                                    </a>
                                </div>
                                <div
                                    className="slick-slider thumbnail-carousel"
                                    id="child-carousel"
                                    data-for=".carousel-parent"
                                    data-arrows="true"
                                    data-loop="false"
                                    data-dots="false"
                                    data-swipe="true"
                                    data-items={2}
                                    data-xs-items={3}
                                    data-sm-items={4}
                                    data-md-items={4}
                                    data-lg-items={5}
                                    data-xl-items={5}
                                    data-slide-to-scroll={1}
                                >
                                    <div className="item">
                                        <div className="product-thumbnail">
                                            <img
                                                src="/assets/images/product-thumbnail-1.jpg"
                                                alt=""
                                                width={130}
                                                height={86}
                                            />
                                        </div>
                                    </div>
                                    <div className="item">
                                        <div className="product-thumbnail">
                                            <img
                                                src="/assets/images/product-thumbnail-2.jpg"
                                                alt=""
                                                width={130}
                                                height={86}
                                            />
                                        </div>
                                    </div>
                                    <div className="item">
                                        <div className="product-thumbnail">
                                            <img
                                                src="/assets/images/product-thumbnail-3.jpg"
                                                alt=""
                                                width={130}
                                                height={86}
                                            />
                                        </div>
                                    </div>
                                    <div className="item">
                                        <div className="product-thumbnail">
                                            <img
                                                src="/assets/images/product-thumbnail-4.jpg"
                                                alt=""
                                                width={130}
                                                height={86}
                                            />
                                        </div>
                                    </div>
                                    <div className="item">
                                        <div className="product-thumbnail">
                                            <img
                                                src="/assets/images/product-thumbnail-5.jpg"
                                                alt=""
                                                width={130}
                                                height={86}
                                            />
                                        </div>
                                    </div>
                                    <div className="item">
                                        <div className="product-thumbnail">
                                            <img
                                                src="/assets/images/product-thumbnail-6.jpg"
                                                alt=""
                                                width={130}
                                                height={86}
                                            />
                                        </div>
                                    </div>
                                </div> */}
                                    <div className="row">
                                        <div className="col-12">
                                            <h4 className="border-bottom">Overview</h4>
                                            <div className="table-mobile offset-custom-11">
                                                <table className="table table-default">
                                                    <tbody>
                                                        <tr>
                                                            <td>Area</td>
                                                            <td>{detail.size} sq ft</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bedrooms</td>
                                                            <td>{detail.bedrooms}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bathrooms</td>
                                                            <td>{detail.bathrooms}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Garages</td>
                                                            <td>{detail.parking_spaces}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Year Built</td>
                                                            <td>{detail.year_built}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Development</td>
                                                            <td>{detail.development_level}</td>
                                                        </tr>
                                                        



                                                    </tbody>
                                                </table>
                                            </div>
                                            <h4 className="border-bottom offset-custom-8">Description</h4>
                                            <p>
                                                <div dangerouslySetInnerHTML={{ __html: detail.description }} />
                                            </p>
                                            
                                           {Features.map((item)=>(
                                            <div className='row mt-3' >
                                               <h6> {item.title}</h6>
                                               
                                               {item.data.map((feature)=>(
                                                <div className='col-12 col-md-3 mt-3  ' >
                                                    <a className='badge bg-success p-1' style={{fontSize:"13px",color:"#FFF",cursor:"pointer",borderRadius:5}}  >{feature.title}</a>
                                                </div>
                                               ))}
                                             
                                                <div></div>
                                            </div>
                                           ))}
                                           
                                        </div>
                                    </div>
                                </div>
                                <div className="col-12 col-md-12 col-lg-4">
                                    <div className="sidebar sidebar-mod-1">
                                        <div className="sidebar-module">
                                            {/*Please, add the data attribute data-key="YOUR_API_KEY" in order to insert your own API key for the Google map.*/}
                                            {/*Please note that YOUR_API_KEY should replaced with your key.*/}
                                            {/*Example: <div class="google-map-container" data-key="YOUR_API_KEY">*/}
                                           
                                            <a
                                                className="btn btn-sushi btn-sm offset-custom-11 btn-full-width"
                                               style={{cursor:"pointer"}}
                                               onClick={()=>navigate("/contact_us",{state:{propertyId:detail.id}})}
                                            >
                                                contact
                                            </a>
                                            {/* <a
                                                className="btn btn-primary btn-sm btn-min-width-md btn-full-width offset-custom-10 mt-3"
                                                href="#"
                                            >
                                                <span className="icon icon-left icon-sm fa-heart" />
                                                add to favoRites
                                            </a> */}
                                        </div>
                                       
                                        <div className="sidebar-module">
                                            <h4 className="border-bottom">Agent Information</h4>
                                            <div className="media media-mod-3">
                                                <div className="media-left img-width-auto">
                                                    <img
                                                        src="https://mybajaproperty.com/wp-content/uploads/2024/05/WhatsApp-Image-2023-11-02-at-17.32.27_54b2daf5-300x300-1.jpg"
                                                        alt=""
                                                        width={100}
                                                        height={100}
                                                        style={{height:100,width:100}}
                                                    />
                                                </div>
                                                <div className="media-body">
                                                    <h5 className="text-sushi">Ron & Aury</h5>
                                                    <p>Oceanfront Property Experts</p>
                                                    <dl className="dl-horizontal-mod-1 text-ubold text-abbey">
                                                        <dt>tel.</dt>
                                                        <dd>
                                                            <a href="callto:#">+1(310) 926-5005</a>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            
                                            {/* <a className="btn btn-primary btn-sm" href="agent-personal.html">
                                                get in touch
                                            </a> */}
                                        </div>
                                        {/* <div className="sidebar-module">
                                            <h4 className="border-bottom">Share</h4>
                                            <div className="icon-group">
                                                <a className="icon icon-sm icon-social fa-facebook" href="#" />
                                                <a className="icon icon-sm icon-social fa-twitter" href="#" />
                                                <a
                                                    className="icon icon-sm icon-social fa-google-plus"
                                                    href="#"
                                                />
                                            </div>
                                        </div> */}
                                        {/* <div className="sidebar-module">
                                            <h4>Recent Properties</h4>
                                            <div className="thumbnail-3">
                                                <img
                                                    src="/assets/images/left_sidebar_blog-1.jpg"
                                                    alt=""
                                                    width={340}
                                                    height={230}
                                                />
                                                <div className="caption">
                                                    <a className="h5 text-sushi" href="#">
                                                        1336 N Occidental Blvd
                                                    </a>
                                                    <p className="text-abbey">
                                                        <span className="text-ubold">$4,339.00</span>
                                                        <span>/month</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div className="thumbnail-3">
                                                <img
                                                    src="/assets/images/left_sidebar_blog-2.jpg"
                                                    alt=""
                                                    width={340}
                                                    height={230}
                                                />
                                                <div className="caption">
                                                    <a className="h5 text-sushi" href="#">
                                                        650 Kelton Ave #201
                                                    </a>
                                                    <p className="text-abbey">
                                                        <span className="text-ubold">$2,449.00</span>
                                                        <span>/month</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div className="thumbnail-3">
                                                <img
                                                    src="/assets/images/left_sidebar_blog-3.jpg"
                                                    alt=""
                                                    width={340}
                                                    height={230}
                                                />
                                                <div className="caption">
                                                    <a className="h5 text-sushi" href="#">
                                                        1735 N Fuller Ave #124
                                                    </a>
                                                    <p className="text-abbey">
                                                        <span className="text-ubold">$2,449.00</span>
                                                        <span>/month</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div> */}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            }
        </>
    )
}

export default PropertyDetail