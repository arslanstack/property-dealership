import React, { useEffect, useRef, useState } from 'react';
import 'react-image-lightbox/style.css'; // This only needs to be imported once in your app
import Lightbox from 'react-image-lightbox';
import imagesLoaded from 'imagesloaded';
import PropertyExperts from '../PropertyExperts/PropertyExperts'
import { GET_NEIGHBORS_DETAIL_URL, GET_NEIGHBORS_PROPERTIES_URL } from '../../Utils/URLs';
import { GetRequest } from '../../Services/Api';
import { useLocation } from 'react-router-dom';
import PreLoading from '../../Components/PreLoading/PreLoading';

import 'leaflet/dist/leaflet.css';
import Masonry, { ResponsiveMasonry } from "react-responsive-masonry"
import GoogleMap from '../../Components/GoogleMap/GoogleMap';
import Paginations from '../../Components/Pagination/Pagination';
import { useNavigate } from 'react-router-dom';


const Neighborhoods = () => {

    const gridRef = useRef(null);
    const [isOpen, setIsOpen] = useState(false);
    const [photoIndex, setPhotoIndex] = useState(0);
    const [isLoading, setIsLoading] = useState(0);
    const [loading, setLoading] = useState(false)
    const [detail, setDetail] = useState({})
    const [properties, setProperties] = useState({})
    const { state } = useLocation()
    const [currentPage, setCurrentPage] = useState(1)
    const [dataDisplay, setDataDisplay] = useState()
    const navigate = useNavigate()
    const lat = Number(detail.latitude)
    const lng = Number(detail.longitude)





    useEffect(() => {
        const GetData = async () => {
            try {
                setLoading(true)
                const res = await GetRequest(`${GET_NEIGHBORS_DETAIL_URL}/${state.neighborId}`)
                setDetail(res.data)
                const property = await GetRequest(`${GET_NEIGHBORS_PROPERTIES_URL}/${state.neighborId}`)
                setProperties(property)
                setLoading(false)
            } catch (error) {
                console.log(error)
                setLoading(false)
            }
        }
        GetData()
    }, [state, currentPage])




    const openLightbox = (index) => {
        setPhotoIndex(index);
        setIsOpen(true);
        setIsLoading(true);
    };

    const handleLightboxClose = () => {
        setIsOpen(false);
        setIsLoading(false);
    };

    const handleImageLoad = () => {
        setIsLoading(false);
    };
    return (
        <>
            {loading ? <PreLoading /> :
                <>
                    <section className="section-full">
                        <div className="container">
                            <div className="row">
                                <div className="col-12">
                                    <h1>{detail.title}</h1>
                                    <p />
                                    <ol className="breadcrumb">
                                        <li>
                                            <a href="/">Home</a>
                                        </li>
                                       
                                        <li className="active">{detail.title}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section className="section-md">
                        <div className="container text-center text-md-start">
                            <h2>{detail.title}</h2>
                            <h4>The Ultimate Baja Real Estate Investment</h4>
                            <hr />
                            <div className="row">
                                <div className="col-12 col-xl-12">
                                    <div className="table-responsive">
                                        <p dangerouslySetInnerHTML={{ __html: detail.description }} />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section className="section-md bg-gray-dark">
                        <div className="container text-center text-xl-start">
                            <div className="row text-start flow-offset-9">
                                <div className="col-12 col-md-4">
                                    <h4>The Beauty of Palacio del Mar</h4>
                                    <p>
                                        Nestled on a 10-acre piece of land, Palacio del Mar offers a picturesque setting
                                        surrounded by mountains, lush vegetation, and the mesmerizing Pacific Ocean.
                                    </p>
                                    <p>
                                        The natural beauty of the surroundings is further enhanced by meticulously designed
                                        landscaping, featuring fountains, waterfalls, and pools that create a serene and tranquil environment.
                                    </p>
                                    <p>
                                        The developers have spared no expense in ensuring that every aspect of Palacio del Mar exudes elegance and sophistication.
                                    </p>
                                </div>
                                <div className="col-12 col-md-4">
                                    <h4>Unbeatable Location and Lifestyle</h4>
                                    <p>
                                        In addition to its stunning natural surroundings
                                        and luxurious amenities, Palacio del Mar boasts an unbeatable location.
                                    </p>
                                    <p>
                                        Situated in Descanso Bay within the municipality of Playas
                                        de Rosarito, this oceanfront community offers a unique and spectacular setting.
                                    </p>
                                    <p>
                                        Just a short 45-minute drive from the Baja and San Diego border, Palacio
                                        del Mar provides easy access to both the tranquility of Baja and the vibrant city life of San Diego.
                                    </p>
                                    <p>
                                        Whether you are looking for a permanent residence or a weekend retreat, Palacio del Mar
                                        offers a lifestyle that combines the best of both worlds.
                                    </p>
                                </div>
                                <div className="col-12 col-md-4">
                                    <img src='/assets/images/placeholder.png' alt='' />
                                </div>

                            </div>
                        </div>
                    </section>
                    <section className="section-md">
                        <div className="container text-center text-xl-start">
                            <h2> {detail.title} Amenities</h2>
                            <span>
                                {detail.title} truly shines with its range of exceptional amenities, designed to ensure
                                that residents enjoy a luxurious lifestyle. Some of these include:
                            </span><br />
                            <hr />
                            <div className="row text-center flow-offset-9">
                                <div className="col-12 col-md-4">
                                    <div className="pricing-wrapper-mod-2 thumbnail-mod-1">
                                        <div className="pricing-head">
                                            <img src={detail.amenity_icon1} style={{ height: 50, width: 50 }} />
                                            <h4 className="fw-r">{detail.amenity_title1}</h4>
                                        </div>
                                        <div className="price">
                                            <p>
                                                {detail.amenity_desc1}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-12 col-md-4">
                                    <div className="pricing-wrapper-mod-2 thumbnail-mod-1">
                                        <div className="pricing-head">
                                            <img src={detail.amenity_icon2} style={{ height: 50, width: 50 }} />
                                            <h4 className="fw-r">{detail.amenity_title2}</h4>
                                        </div>
                                        <div className="price">
                                            <p>
                                                {detail.amenity_desc2}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-12 col-md-4">
                                    <div className="pricing-wrapper-mod-2 thumbnail-mod-1">
                                        <div className="pricing-head">
                                            <img src={detail.amenity_icon3} style={{ height: 50, width: 50 }} />
                                            <h4 className="fw-r">{detail.amenity_title3}</h4>
                                        </div>
                                        <div className="price">
                                            <p>
                                                {detail.amenity_desc3}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section className="section-md">
                        <div className="container text-center ">
                            <h2>{detail.title} Properties</h2>
                            <hr />

                            <div className="row text-start flow-offset-9">
                                <div className="row clearleft-custom-5">
                                    {properties?.data?.data?.map((item) => (
                                        <div className="col-12 col-md-4">
                                            <div className="thumbnail thumbnail-3" style={{ position: "relative" }} >
                                                <a className="img-link" onClick={() => navigate(`/property/${item.slug}`, { state: { propertyId: item.id } })} style={{ cursor: "pointer" }}>
                                                    <div className='badge bg-success p-2' style={{ position: "absolute", zIndex: 2, top: 20, left: 20 }} >
                                                        {item.listing_status}
                                                    </div>
                                                    <img
                                                        src={item.banner}
                                                        alt=""
                                                        width={370}
                                                        height={250}
                                                        style={{ height: 250, width: 370 }}
                                                    />
                                                </a>
                                                <div className="caption">
                                                    <h4>
                                                        <a
                                                            className="text-sushi"
                                                            onClick={() => navigate(`/property/${item.slug}`, { state: { propertyId: item.id } })}
                                                            style={{ cursor: "pointer" }}
                                                        >
                                                            {item.title}
                                                        </a>
                                                    </h4>
                                                    <span className="thumbnail-price h5">
                                                        ${item.price}{item.listing_type === "rent" ? <span className="mon text-regular">/{item.rent_cycle}</span> : null}
                                                    </span>
                                                    <ul className="describe-1">
                                                        <li>
                                                            <span className="icon icon-xs icon-primary mdi mdi-vector-square">

                                                            </span>
                                                            <span className='align-bottom' >

                                                                {item.size} sq ft
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span className="icon icon-xs icon-primary fa-solid fa-bath" />
                                                            <span className='align-bottom' >

                                                                {item.bathrooms} bathrooms
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <ul className="describe-2">
                                                        <li >
                                                            <span className="icon icon-xs icon-primary fa-bed " />
                                                            <span className='mx-2 align-bottom ' >

                                                                {item.bedrooms} bedrooms
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class=" icon icon-xs icon-primary fa-solid fa-warehouse"></span>
                                                            <span className='mx-1 align-bottom' >

                                                                {item.parking_spaces} garages
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <p className="text-abbey">
                                                        {item.short_description}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    ))}


                                </div>
                            </div>
                            {properties?.data?.data?.length !== 0 ?
                                <Paginations
                                    users={properties?.data?.data}
                                    usersPerPage={6}
                                    UsersToDisplay={(d) => setDataDisplay(d)}
                                    totalRecords={properties?.data?.total}
                                    currentPage={currentPage}
                                    setCurrentPage={setCurrentPage}
                                />
                                : null}
                        </div>
                    </section>

                    <section className="section-sm">
                        <div className="container  gallery">
                            <h2>Image Gallery</h2>
                            <hr />
                            <div className=" mt-4" ref={gridRef}>
                                <div className="grid-sizer"></div>
                                <ResponsiveMasonry
                                    columnsCountBreakPoints={{ 350: 1, 750: 2, 900: 3 }}

                                >
                                    <Masonry gutter='20px' >
                                        {detail?.images?.map((image, index) => (

                                            <div className="" key={index} onClick={() => openLightbox(index)}>
                                                <img src={image} alt={image} />
                                            </div>

                                        ))}
                                    </Masonry>
                                </ResponsiveMasonry>
                            </div>
                            {isOpen && (
                                <Lightbox
                                    mainSrc={detail?.images[photoIndex]}
                                    nextSrc={detail.images[(photoIndex + 1) % detail.images.length]}
                                    prevSrc={detail.images[(photoIndex + detail.images.length - 1) % detail.images.length]}
                                    onCloseRequest={handleLightboxClose}
                                    onMovePrevRequest={() => setPhotoIndex((photoIndex + detail.images.length - 1) % detail.images.length)}
                                    onMoveNextRequest={() => setPhotoIndex((photoIndex + 1) % detail.images.length)}
                                    onImageLoad={handleImageLoad}
                                    imageLoadErrorMessage="Failed to load image"
                                    enableZoom={true}
                                    reactModalStyle={{ overlay: { zIndex: 2000 } }}
                                    imagePadding={1}
                                    animationDisabled={false}
                                    loading={isLoading}

                                />
                            )}
                        </div>
                    </section>


                    {Object.keys(detail).length !== 0 &&

                        <section>
                            <div className='container mb-4' >
                                <h2 className='mt-4' >{detail.title} Location </h2>

                                <hr />
                            </div>
                            <GoogleMap lat={lat} lng={lng} label={detail.title} />
                        </section>
                    }
                    <PropertyExperts />
                </>
            }
        </>
    )
}

export default Neighborhoods
