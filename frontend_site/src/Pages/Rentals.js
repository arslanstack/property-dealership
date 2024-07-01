import React, { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { GET_PROPERTIES_URL } from '../Utils/URLs'
import { PostRequest } from '../Services/Api'
import Paginations from '../Components/Pagination/Pagination'
const Rentals = () => {
    const navigate = useNavigate()
    const [loading, setLoading] = useState(true)
    const [properties, setProperties] = useState({})
    const [currentPage, setCurrentPage] = useState(1)
    const [dataDisplay, setDataDisplay] = useState()

    useEffect(() => {
        const GetData = async () => {
            try {
                const data = {
                    listing_type: 2
                }
                const res = await PostRequest(GET_PROPERTIES_URL, data)
                setProperties(res)
                setLoading(false)

            } catch (error) {
                console.log(error)
                setLoading(false)
            }
        }
        GetData()
    }, [])


    return (
        <>
            <main className="page-content text-start">
                {/* Section Title Breadcrumbs*/}
                <section className="section-full section-full-mod-1">
                    <div className="container">
                        <div className="row">
                            <div className="col-12">
                                <h1>Rentals </h1>
                                <p />
                                <ol className="breadcrumb">
                                    <li>
                                    <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a>
                                    </li>

                                    <li className="active">Rentals</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                {/*Section Find your home*/}

                {/* Section Catalog*/}
                <section className="section-lg">
                    <div className="container">
                        <div className="row justify-content-xs-between">
                            <div className="col-12 col-md-3 text-center text-md-start">
                                {/* RD SelectMenu*/}
                                {/* <div className="sort-input">
                                    <div className="form-wrap form-wrap-mod-1">
                                        <label className="form-label" htmlFor="sort-1">
                                            Sorting
                                        </label>
                                        
                                        <select
                                            className="form-input select-filter"
                                            id="sort-1"
                                            data-minimum-results-for-search="Infinity"
                                        >
                                            <option value="By Price" selected="">
                                                By Price
                                            </option>
                                            <option value="By Date">By Date</option>
                                            <option value="By Square">By Square</option>
                                            <option value="By Location">By Location</option>
                                        </select>
                                    </div>
                                </div> */}
                            </div>
                            {/* <div className="col-12 col-md-4 text-center text-md-end">
                                <div className="btn-group-mod-3 sorting">
                                    <a
                                        className="btn btn-primary-transparent btn-sm"
                                        href="property-catalog-list.html"
                                    >
                                        List
                                    </a>
                                    <a
                                        className="btn btn-primary-transparent btn-sm active"
                                        href="property-catalog-grid.html"
                                    >
                                        Grid
                                    </a>
                                </div>
                            </div> */}
                        </div>
                        {loading ?
                            <div class="cssload-container" style={{ height: 200, display: "flex", justifyContent: "center", alignItems: "center" }} >
                                <div class="cssload-speeding-wheel"></div>
                            </div> :
                            <div className="row">
                                <div className="col-12 col-xl-12">
                                    <div className="row clearleft-custom-5">
                                        {properties?.data?.data?.map((item) => (
                                            <div key={item.id} className="col-12 col-md-4">
                                                <div className="thumbnail thumbnail-3" style={{position:"relative"}} >
                                                    <a className="img-link" onClick={() => navigate(`/property/${item.slug}`, { state: { propertyId: item.id } })} style={{ cursor: "pointer" }} >
                                                        <div className='badge bg-success p-2' style={{ position: "absolute", zIndex: 2, top: 20, left: 20 }} >
                                                            {item.listing_status}
                                                        </div>
                                                        <img
                                                            src={item.banner}
                                                            alt=""
                                                            width={370}
                                                            height={250}
                                                            style={{ height: 250 }}
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
                                                            ${item.price}<span className="mon text-regular">{item.listing_type === "rent" ? `/${item.rent_cycle}` : ""}</span>
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

                            </div>
                        }
                        {properties?.data?.data?.length !== 0 ?
                            <Paginations
                                users={properties?.data?.data}
                                usersPerPage={6}
                                UsersToDisplay={(d) => setDataDisplay(d)}
                                totalRecords={properties?.records_count}
                                currentPage={currentPage}
                                setCurrentPage={setCurrentPage}
                            />
                            : null}
                    </div>
                </section>
            </main>
        </>
    )
}

export default Rentals