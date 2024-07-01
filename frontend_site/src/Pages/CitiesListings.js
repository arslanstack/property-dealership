import React, { useState, useEffect } from 'react'
import { GetRequest, PostRequest } from '../Services/Api'
import { GET_CITY_DETAIL_URL, GET_CITY_PROPERTIES_URL, GET_FILTERS_URL } from '../Utils/URLs'
import { useLocation, useNavigate } from 'react-router-dom'
import PreLoading from '../Components/PreLoading/PreLoading'
import Paginations from '../Components/Pagination/Pagination'

const CitiesListings = () => {
    const { state, search, pathname } = useLocation()
    const navigate = useNavigate()
    const [viewType, setViewType] = useState("grid")
    const [loading, setLoading] = useState(true)
    const [cityDetail, setCityDetail] = useState({})
    const [properties, setProperties] = useState([])
    const [filters, setFilters] = useState([])
    const [sorting, setSorting] = useState(1)
    const [searchName, setSearchName] = useState({})
    const [currentPage, setCurrentPage] = useState(1)
    const [dataLoading, setDataLoading] = useState(false)
    const [dataDisplay, setDataDisplay] = useState()
    useEffect(() => {
        const GetData = async () => {
            try {
                setSearchName({})
                setLoading(true)
                const city = await GetRequest(`${GET_CITY_DETAIL_URL}/${state.cityId}`)
                setCityDetail(city.data)

                const filter = await GetRequest(GET_FILTERS_URL)
                setFilters(filter.data.sorting)

                setLoading(false)
            } catch (error) {
                console.log(error)
                setLoading(false)
            }
        }
        window.scrollTo({
            top: 0,
            behavior: "instant"
        })
        GetData()
    }, [pathname])
    useEffect(() => {
        const GetData = async () => {
            try {
                setDataLoading(true)
                var data = {}

                if (search) {
                    const Localsorting = localStorage.getItem("sorting")
                    const LocalSortingName = localStorage.getItem("sortingName")
                    console.log(Localsorting)
                    if (search.includes("sortby")) {
                        setSorting(parseInt(Localsorting))
                        setSearchName({ sortby: LocalSortingName })
                    }
                    data = {
                        city_id: cityDetail.id,
                        ...(search.includes("sortby") ? { sorting: Localsorting } : {})
                    }
                } else {
                    data = {
                        city_id: cityDetail.id,
                        sorting: JSON.parse(sorting).id
                    }
                }

                const property = await PostRequest(GET_CITY_PROPERTIES_URL, data)
                setProperties(property)
                setDataLoading(false)
                if (Object.keys(searchName).length !== 0) {

                    const queryString = new URLSearchParams(searchName).toString();
                    navigate(`${pathname}?${queryString}`, { state: { cityId: cityDetail.id } })
                }
            } catch (error) {
                console.log(error)
                setDataLoading(false)
            }
        }
        if (Object.keys(cityDetail).length !== 0) {
            GetData()
        }

    }, [cityDetail, sorting, currentPage])

    return (
        <>
            {loading ? <PreLoading /> :
                <main className="page-content text-start">
                    {/* Section Title Breadcrumbs*/}
                    <section className="section-full section-full-mod-1">
                        <div className="container">
                            <div className="row">
                                <div className="col-12">
                                    <h1>{cityDetail.name} Listing </h1>
                                    <p />
                                    <ol className="breadcrumb">
                                        <li>
                                        <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a>
                                        </li>

                                        <li className="active">{cityDetail.name} Listing </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </section>
                    {/*Section Find your home*/}

                    {/* Section Catalog*/}
                    <section className="section-lg" data-select2-id={19}>
                        <div className="container" data-select2-id={18}>
                            <div className="row justify-content-xs-between" data-select2-id={17}>
                                <div
                                    className="col-12 col-md-7 text-center text-md-start d-flex align-items-end "
                                    data-select2-id={16}
                                >

                                    <div className="sort-input  " data-select2-id={15}>
                                        <div className="form-wrap form-wrap-mod-1" data-select2-id={14}>
                                            <label
                                                className="form-label rd-input-label focus not-empty"
                                                htmlFor="sort-1"
                                            >
                                                Sorting
                                            </label>
                                            {/*Select 2*/}
                                            <select
                                                className="form-input select-filter"
                                                id="sort-1"
                                                data-minimum-results-for-search="Infinity"
                                                data-select2-id="sort-1"
                                                tabIndex={-1}
                                                aria-hidden="true"
                                                onChange={(e) => {
                                                    const selected = JSON.parse(e.target.value)
                                                    setSorting(e.target.value)
                                                    setCurrentPage(1)
                                                    localStorage.setItem("sorting", selected.id)
                                                    localStorage.setItem("sortingName", selected.title)
                                                    setSearchName({ sortby: selected.title })
                                                }}
                                            >
                                                {filters.map((item) => (
                                                    <option selected={searchName.sortby === item.title} value={JSON.stringify({ id: item.id, title: item.title })} data-select2-id={12}>
                                                        {item.title}
                                                    </option>
                                                ))}


                                            </select>

                                        </div>
                                    </div>


                                </div>
                                <div className="col-12 col-md-5  d-flex justify-content-end ">

                                    <div className="btn-group-mod-3 sorting d-flex mx-1 align-items-end ">
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
                                viewType === "grid" ?
                                    <div className="row">
                                        <div className="col-12 col-xl-12">
                                            <div className="row clearleft-custom-5">
                                                {properties?.data?.data?.map((item) => (
                                                    <div key={item.id} className="col-12 col-md-4">
                                                        <div className="thumbnail thumbnail-3" style={{ position: "relative" }} >
                                                            <a className="img-link" onClick={() => navigate(`/property/${item.slug}`, { state: { propertyId: item.id } })} style={{ cursor: "pointer" }} >
                                                                <div className='badge bg-success p-2' style={{ position: "absolute", zIndex: 999, top: 20, left: 20 }} >
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
                                                                    ${item.price}<span className="mon text-regular">{item.listing_status === "For Rent" ? "/month" : ""}</span>
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
                                    :
                                    <section className="section-lg">
                                        <div className="container">

                                            <div className="row">
                                                <div className="col-12 col-xl-12">
                                                    <div className="row">
                                                        {properties?.data?.data?.map((item) => (
                                                            <div key={item.id} className="col-12 col-md-12">
                                                                <div className="media thumbnail thumbnail-3 media-mod-2" style={{ position: "relative" }} >
                                                                    <div className="media-left">
                                                                        <a className="img-link" onClick={() => navigate(`/property/${item.slug}`, { state: { propertyId: item.id } })} style={{ cursor: "pointer" }}>
                                                                            <div className='badge bg-success p-2' style={{ position: "absolute", zIndex: 999, top: 20, left: 20 }} >
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
                                    UsersToDisplay={(e) => setDataDisplay(e)}
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

export default CitiesListings