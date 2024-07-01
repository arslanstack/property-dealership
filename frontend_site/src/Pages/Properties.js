import React, { useEffect, useState } from 'react'
import { PostRequest, GetRequest } from '../Services/Api';
import { GET_PROPERTIES_URL, GET_FILTERS_URL } from '../Utils/URLs';
import PreLoading from '../Components/PreLoading/PreLoading';
import { useNavigate, useLocation } from 'react-router-dom';
import Paginations from '../Components/Pagination/Pagination';

const Properties = () => {
    const navigate = useNavigate()
    const { search } = useLocation()
    const [showSearch, setShowSearch] = useState(false)
    const [price, setPrice] = useState([600, 9500])
    const [area, setArea] = useState([1600, 20000])
    const [viewType, setViewType] = useState("grid")
    const [properties, setProperties] = useState({})
    const [filters, setFilters] = useState({})
    const [statusFilter, setStatusFilter] = useState("all")
    const [loading, setLoading] = useState(false)
    const [dataLoading, setDataLoading] = useState(false)
    const [sorting, setSorting] = useState(1)
    const [currentPage, setCurrentPage] = useState(1)
    const [dataDisplay, setDataDisplay] = useState()
    const [searchName, setSearchName] = useState({})

    console.log("search.........", search)
    useEffect(() => {
        const GetData = async () => {
            setLoading(true)
            const filter = await GetRequest(GET_FILTERS_URL)
            setFilters(filter.data)
            setLoading(false)

        }
        GetData()
        window.scrollTo({
            top: 0,
            behavior: "instant"
        })
    }, [])
    useEffect(() => {
        const PostData = async () => {
            setDataLoading(true)
            var data = {}
            if (search) {
                const Localstatus = localStorage.getItem("status")
                const Localsorting = localStorage.getItem("sorting")
                const LocalStatusName = localStorage.getItem("statusName")
                const LocalSortingName = localStorage.getItem("sortingName")
                console.log("from locallll", Localstatus, LocalSortingName)
                if (search.includes("status")) {
                    setStatusFilter(parseInt(Localstatus))
                    setSearchName((prev) => ({ ...prev, status: LocalStatusName }))
                }
                if (search.includes("sortby")) {
                    setSorting(parseInt(Localsorting))
                    setSearchName((prev) => ({ ...prev, sortby: LocalSortingName }))
                }
                data = {
                    ...(search.includes("status") ? { listing_status: Localstatus } : {}),
                    ...(search.includes("sortby") ? { sorting: Localsorting } : {}),
                    ...(statusFilter !== "all" ? { listing_status: statusFilter } : {}),
                }
            }else{
                data = {
                    ...(statusFilter !== "all" ? { listing_status: statusFilter } : {}),
                    sorting: JSON.parse(sorting).id
                }
            }
           



            const proprty = await PostRequest(`${GET_PROPERTIES_URL}?page=${currentPage}`, data)
            setProperties(proprty)
            setDataLoading(false)
        }
        PostData()
        const propertyData = document.getElementById("property-data")
        if (propertyData) {
            propertyData.scrollIntoView({ behavior: "instant" })
        }
        if (Object.keys(searchName).length !== 0) {
            const queryString = new URLSearchParams(searchName).toString();
            navigate(`/property?${queryString}`)
        }

    }, [statusFilter, sorting, currentPage, search])


    return (
        <>
            {loading ? <PreLoading /> :
                <main className="page-content text-start">
                    {/* Section Title Breadcrumbs*/}
                    <section className="section-full section-full-mod-1">
                        <div className="container">
                            <div className="row">
                                <div className="col-12">
                                    <h1>Property </h1>
                                    <p />
                                    <ol className="breadcrumb">
                                        <li>
                                        <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a>
                                        </li>

                                        <li className="active">Property</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </section>


                    {/* Section Catalog*/}
                    <section className="section-lg" data-select2-id={19} id="property-data" >
                        <div className="container" data-select2-id={18}>
                            <div className="row justify-content-xs-between" data-select2-id={17}>
                                <div
                                    className="col-12 col-md-7 text-center text-md-start d-flex align-items-end "
                                    data-select2-id={16}
                                >
                                    <div className="tabs-custom tabs-custom-buttons" id="tabs-3">
                                        <ul className="nav nav-tabs" role="tablist">
                                            <li className="nav-item" role="presentation">
                                                <a
                                                    className={`nav-link btn btn-primary-transparent btn-xs w-100 w-md-auto ${searchName.status === "all" || Object.keys(searchName).length === 0 ? 'active' : ""} `}
                                                    href="#tabs-3-1"
                                                    data-bs-toggle="tab"
                                                    aria-selected="false"
                                                    role="tab"
                                                    tabIndex={-1}
                                                    onClick={() => {
                                                        setStatusFilter("all")
                                                        setSearchName((prev) => ({ ...prev, status: "all" }))
                                                        setCurrentPage(1)
                                                        localStorage.setItem("status", "all")
                                                        localStorage.setItem("statusName", "all")
                                                    }}
                                                >
                                                    All
                                                </a>
                                            </li>
                                            {filters?.listing_status?.map((item, index) => (
                                                <li key={index} className="nav-item" role="presentation">
                                                    <a
                                                        className={`nav-link btn btn-primary-transparent btn-xs w-100 w-md-auto ${statusFilter === item.id ? 'active' : ""}`}
                                                        href="#tabs-3-2"
                                                        data-bs-toggle="tab"
                                                        aria-selected="false"
                                                        role="tab"
                                                        tabIndex={-1}
                                                        onClick={() => {
                                                            setStatusFilter(item.id)
                                                            setSearchName((prev) => ({ ...prev, status: item.title }))
                                                            setCurrentPage(1)
                                                            localStorage.setItem("status", item.id)
                                                            localStorage.setItem("statusName", item.title)
                                                        }}
                                                    >
                                                        {item.title}
                                                    </a>
                                                </li>
                                            ))}

                                            {/* <li className="nav-item" role="presentation">
                                            <a
                                                className="nav-link btn btn-primary-transparent btn-xs"
                                                href="#tabs-3-3"
                                                data-bs-toggle="tab"
                                                aria-selected="false"
                                                role="tab"
                                                tabIndex={-1}
                                            >
                                                For Rent
                                            </a>
                                        </li>
                                        <li className="nav-item" role="presentation">
                                            <a
                                                className="nav-link btn btn-primary-transparent btn-xs "
                                                href="#tabs-3-4"
                                                data-bs-toggle="tab"
                                                aria-selected="true"
                                                role="tab"
                                            >
                                                Rented
                                            </a>
                                        </li>
                                        <li className="nav-item" role="presentation">
                                            <a
                                                className="nav-link btn btn-primary-transparent btn-xs"
                                                href="#tabs-3-5"
                                                data-bs-toggle="tab"
                                                aria-selected="true"
                                                role="tab"
                                            >
                                                Sale Pending
                                            </a>
                                        </li>
                                        <li className="nav-item" role="presentation">
                                            <a
                                                className="nav-link btn btn-primary-transparent btn-xs"
                                                href="#tabs-3-6"
                                                data-bs-toggle="tab"
                                                aria-selected="true"
                                                role="tab"
                                            >
                                                Sold
                                            </a>
                                        </li> */}
                                        </ul>

                                    </div>
                                </div>
                                <div className="col-12 col-md-5  d-block d-md-flex  justify-content-end ">
                                    <div className="sort-input w-100 w-md-auto " data-select2-id={15}>
                                        <div className="form-wrap form-wrap-mod-1 w-100 w-md-auto" data-select2-id={14}>
                                            <label
                                                className="form-label rd-input-label focus not-empty"
                                                htmlFor="sort-1"
                                            >
                                                Sorting
                                            </label>
                                            {/*Select 2*/}
                                            <select
                                                className="form-input select-filter w-100 w-md-auto"
                                                id="sort-1"
                                                data-minimum-results-for-search="Infinity"
                                                data-select2-id="sort-1"
                                                tabIndex={-1}
                                                aria-hidden="true"

                                                onChange={(e) => {
                                                    const selected = JSON.parse(e.target.value)
                                                    setSorting(e.target.value)
                                                    setSearchName((prev) => ({ ...prev, sortby: selected.title }))
                                                    setCurrentPage(1)
                                                    localStorage.setItem("sorting", selected.id)
                                                    localStorage.setItem("sortingName", selected.title)
                                                }}
                                            >
                                                {filters?.sorting?.map((item) => (
                                                    <option key={item.id} selected={searchName.sortby === item.title} value={JSON.stringify({ id: item.id, title: item.title })} data-select2-id={12}>
                                                        {item.title}
                                                    </option>
                                                ))}
                                            </select>

                                        </div>
                                    </div>
                                    <div className="btn-group-mod-3 sorting d-flex mt-4 mt-md-0 justify-content-center  mx-1 align-items-end ">
                                        <a
                                            className={` btn btn-md btn-primary-transparent ${viewType === "list" ? 'active' : ""} `}
                                            onClick={() => setViewType("list")}
                                        >
                                            <i className='icon icon-sm icon-primary material-icons-list' ></i>
                                        </a>
                                        <a
                                            className={` btn btn-md btn-primary-transparent ${viewType === "grid" ? 'active' : ""} `}
                                            onClick={() => setViewType("grid")}
                                        >
                                            <i className='icon icon-sm icon-primary material-icons-grid_on' ></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {dataLoading ?
                                <div class="cssload-container" style={{ height: 200, display: "flex", justifyContent: "center", alignItems: "center" }} >
                                    <div class="cssload-speeding-wheel"></div>
                                </div>

                                :
                                properties?.data?.data?.length === 0 ?
                                    <h1 className='title text-center my-5' >No Properties Found</h1>
                                    :
                                    viewType === "grid" ?
                                        <div className="row">
                                            <div className="col-12 col-xl-12">
                                                <div className="row clearleft-custom-5">
                                                    {properties?.data?.data?.map((item) => (
                                                        <div key={item.id} className="col-12 col-md-4">
                                                            <div className="thumbnail thumbnail-3" style={{ position: "relative" }} >
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
                                                    {/* <div className="col-12 col-md-4">
                                            <div className="thumbnail thumbnail-3">
                                                <a className="img-link" href="property-catalog-single.html">
                                                    <img
                                                        src="/assets/images/index-7.jpg"
                                                        alt=""
                                                        width={370}
                                                        height={250}
                                                    />
                                                </a>
                                                <div className="caption">
                                                    <h4>
                                                        <a
                                                            className="text-sushi"
                                                            href="property-catalog-single.html"
                                                        >
                                                            225 Maywood Dr, San Francisco, CA 94127
                                                        </a>
                                                    </h4>
                                                    <span className="thumbnail-price h5">
                                                        $2,229.00/<span className="mon text-regular">month</span>
                                                    </span>
                                                    <ul className="describe-1">
                                                        <li>
                                                            <span className="icon icon-xs icon-primary mdi mdi-vector-square">
                                                                
                                                            </span>
                                                            <span className='align-bottom' >

                                                            1200 sq ft
                                                            </span>
                                                        </li>
                                                        <li>
                                                        
                                                            <span className="icon icon-xs icon-primary fa-solid fa-bath" />
                                                            <span className='align-bottom' >

                                                            2 bathrooms
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <ul className="describe-2">
                                                        <li >
                                                            <span className="icon icon-xs icon-primary fa-bed " />
                                                           <span className='mx-2 align-bottom ' >

                                                            4 bedrooms
                                                           </span>
                                                        </li>
                                                        <li>
                                                             <span class=" icon icon-xs icon-primary fa-solid fa-warehouse"></span>
                                                             <span className='mx-2 align-bottom'>

                                                            2 garages
                                                             </span>
                                                        </li>
                                                    </ul>
                                                    <p className="text-abbey">
                                                        One of the original homes built at Ocean Beach.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-12 col-md-4">
                                            <div className="thumbnail thumbnail-3">
                                                <a className="img-link" href="property-catalog-single.html">
                                                    <img
                                                        src="/assets/images/index-8.jpg"
                                                        alt=""
                                                        width={370}
                                                        height={250}
                                                    />
                                                </a>
                                                <div className="caption">
                                                    <h4>
                                                        <a
                                                            className="text-sushi"
                                                            href="property-catalog-single.html"
                                                        >
                                                            2266 48th Ave
                                                        </a>
                                                    </h4>
                                                    <span className="thumbnail-price h5">
                                                        $1,339.00/<span className="mon text-regular">month</span>
                                                    </span>
                                                    <ul className="describe-1">
                                                        <li>
                                                            <span className="icon icon-xs icon-primary mdi mdi-vector-square">
                                                                
                                                            </span>
                                                            <span className='align-bottom' >

                                                            1200 sq ft
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span className="icon icon-xs icon-primary fa-solid fa-bath" />
                                                            <span className='align-bottom' >

                                                            2 bathrooms
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <ul className="describe-2">
                                                        <li >
                                                            <span className="icon icon-xs icon-primary fa-bed " />
                                                           <span className='mx-2 align-bottom ' >

                                                            4 bedrooms
                                                           </span>
                                                        </li>
                                                        <li>
                                                             <span class=" icon icon-xs icon-primary fa-solid fa-warehouse"></span>
                                                             <span className='mx-2 align-bottom'>

                                                            2 garages
                                                             </span>
                                                        </li>
                                                    </ul>
                                                    <p className="text-abbey">
                                                        Classic architectural detail, truly superb floor plan &amp;
                                                        strong upside potential for the next steward to restore this
                                                        forever home to greatness.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-12 col-md-4">
                                            <div className="thumbnail thumbnail-3">
                                                <a className="img-link" href="property-catalog-single.html">
                                                    <img
                                                        src="/assets/images/index-9.jpg"
                                                        alt=""
                                                        width={370}
                                                        height={250}
                                                    />
                                                </a>
                                                <div className="caption">
                                                    <h4>
                                                        <a
                                                            className="text-sushi"
                                                            href="property-catalog-single.html"
                                                        >
                                                            1336 N Occidental Blvd
                                                        </a>
                                                    </h4>
                                                    <span className="thumbnail-price h5">
                                                        $4,339.00/<span className="mon text-regular">month</span>
                                                    </span>
                                                    <ul className="describe-1">
                                                        <li>
                                                            <span className="icon icon-xs icon-primary mdi mdi-vector-square">
                                                                
                                                            </span>
                                                            <span className='align-bottom' >

                                                            1200 sq ft
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span className="icon icon-xs icon-primary fa-solid fa-bath" />
                                                            <span className='align-bottom' >

                                                            2 bathrooms
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <ul className="describe-2">
                                                        <li >
                                                            <span className="icon icon-xs icon-primary fa-bed " />
                                                           <span className='mx-2 align-bottom ' >

                                                            4 bedrooms
                                                           </span>
                                                        </li>
                                                        <li>
                                                             <span class=" icon icon-xs icon-primary fa-solid fa-warehouse"></span>
                                                             <span className='mx-2 align-bottom'>

                                                            2 garages
                                                             </span>
                                                        </li>
                                                    </ul>
                                                    <p className="text-abbey">
                                                        Located in the heart of Silver Lake, this magnificently
                                                        re-imagined Spanish bungalow is not to be missed.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-12 col-md-4">
                                            <div className="thumbnail thumbnail-3">
                                                <a className="img-link" href="property-catalog-single.html">
                                                    <img
                                                        src="/assets/images/index-10.jpg"
                                                        alt=""
                                                        width={370}
                                                        height={250}
                                                    />
                                                </a>
                                                <div className="caption">
                                                    <h4>
                                                        <a
                                                            className="text-sushi"
                                                            href="property-catalog-single.html"
                                                        >
                                                            650 Kelton Ave #201
                                                        </a>
                                                    </h4>
                                                    <span className="thumbnail-price h5">
                                                        $2,229.00/<span className="mon text-regular">month</span>
                                                    </span>
                                                    <ul className="describe-1">
                                                        <li>
                                                            <span className="icon icon-xs icon-primary mdi mdi-vector-square">
                                                                
                                                            </span>
                                                            <span className='align-bottom' >

                                                            1200 sq ft
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span className="icon icon-xs icon-primary fa-solid fa-bath" />
                                                            <span className='align-bottom' >

                                                            2 bathrooms
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <ul className="describe-2">
                                                        <li >
                                                            <span className="icon icon-xs icon-primary fa-bed " />
                                                           <span className='mx-2 align-bottom ' >

                                                            4 bedrooms
                                                           </span>
                                                        </li>
                                                        <li>
                                                             <span class=" icon icon-xs icon-primary fa-solid fa-warehouse"></span>
                                                             <span className='mx-2 align-bottom'>

                                                            2 garages
                                                             </span>
                                                        </li>
                                                    </ul>
                                                    <p className="text-abbey">
                                                        Front-facing, single level, well-designed floor plan. Secure
                                                        building in a highly DESIRABLE location!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-12 col-md-4">
                                            <div className="thumbnail thumbnail-3">
                                                <a className="img-link" href="property-catalog-single.html">
                                                    <img
                                                        src="/assets/images/index-11.jpg"
                                                        alt=""
                                                        width={370}
                                                        height={250}
                                                    />
                                                </a>
                                                <div className="caption">
                                                    <h4>
                                                        <a
                                                            className="text-sushi"
                                                            href="property-catalog-single.html"
                                                        >
                                                            1735 N Fuller Ave #124
                                                        </a>
                                                    </h4>
                                                    <span className="thumbnail-price h5">
                                                        $1,339.00/<span className="mon text-regular">month</span>
                                                    </span>
                                                    <ul className="describe-1">
                                                        <li>
                                                            <span className="icon icon-xs icon-primary mdi mdi-vector-square">
                                                                
                                                            </span>
                                                            <span className='align-bottom' >

                                                            1200 sq ft
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span className="icon icon-xs icon-primary fa-solid fa-bath" />
                                                            <span className='align-bottom' >

                                                            2 bathrooms
                                                            </span>
                                                        </li>
                                                    </ul>
                                                    <ul className="describe-2">
                                                        <li >
                                                            <span className="icon icon-xs icon-primary fa-bed " />
                                                           <span className='mx-2 align-bottom ' >

                                                            4 bedrooms
                                                           </span>
                                                        </li>
                                                        <li>
                                                             <span class=" icon icon-xs icon-primary fa-solid fa-warehouse"></span>
                                                             <span className='mx-2 align-bottom'>

                                                            2 garages
                                                             </span>
                                                        </li>
                                                    </ul>
                                                    <p className="text-abbey">
                                                        This charming 2 bed and 2 bath townhome has been beautifully
                                                        renovated and ready for its next owners.
                                                    </p>
                                                </div>
                                            </div>
                                        </div> */}

                                                </div>
                                            </div>

                                        </div>
                                        :
                                        <section className="section-lg">
                                            <div className="container">

                                                <div className="row">
                                                    <div className="col-12 col-xl-12">
                                                        <div className="row">
                                                            {properties?.data?.data?.map((item) => (
                                                                <div key={item.id} className="col-12 col-md-12">
                                                                    <div className="media thumbnail thumbnail-3 media-mod-2" style={{position:"relative"}} >
                                                                        <div className="media-left">
                                                                            <a className="img-link" onClick={() => navigate(`/property/${item.slug}`, { state: { propertyId: item.id } })} style={{ cursor: "pointer" }}>
                                                                                <div className='badge bg-success p-2' style={{ position: "absolute", zIndex: 2, top: 20, left: 20 }} >
                                                                                    {item.listing_status}
                                                                                </div>
                                                                                <img
                                                                                    src={item.banner}
                                                                                    alt=""
                                                                                    style={{ width: 270, height: 180 }}
                                                                                    width={270}
                                                                                    height={180}
                                                                                />
                                                                            </a>
                                                                        </div>
                                                                        <div className="media-body caption">
                                                                            <h4>
                                                                                <a className="text-sushi" onClick={() => navigate(`/property/${item.slug}`, { state: { propertyId: item.id } })} style={{ cursor: "pointer" }}>
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
                                                                                    <span className='mx-2 align-bottom'>

                                                                                        {item.parking_spaces} garages
                                                                                    </span>
                                                                                </li>
                                                                            </ul>
                                                                            <p>
                                                                                {item.short_description}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            ))}



                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </section>



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
            }
        </>
    )
}

export default Properties