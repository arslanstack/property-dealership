import React, { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { GET_SEARCH_VALUES_URL, GET_SEARCH_URL } from '../Utils/URLs'
import { GetRequest, PostRequest } from '../Services/Api'
import Paginations from '../Components/Pagination/Pagination'
import { Animation, RangeSlider } from 'rsuite';
import { useLocation } from 'react-router-dom'
const Search = () => {
  const navigate = useNavigate()
  const [loading, setLoading] = useState(true)
  const [properties, setProperties] = useState({})
  const [currentPage, setCurrentPage] = useState(1)
  const [dataDisplay, setDataDisplay] = useState()
  const [showSearch, setShowSearch] = useState(false)
  const [price, setPrice] = useState([])
  const [area, setArea] = useState([])
  const [searchValues, setSearchValues] = useState({})
  const [searchName, setSearchName] = useState({})
  const [keyword, setKeyword] = useState("")
  const [location, setLoccation] = useState("")
  const [status, setStatus] = useState("")
  const [type, setType] = useState("")
  const [min_bed, setMin_bed] = useState("")
  const [min_bath, setMin_bath] = useState("")
  const [dataLoading, setDataLoading] = useState(false)
  // const { state } = useLocation()
  const state = JSON.parse(localStorage.getItem("mainSearchValue"))
  const names = JSON.parse(localStorage.getItem("mainSearchName"))
  console.log("state value.....", state)
  useEffect(() => {
    const GetData = async () => {
      try {
        const search = await GetRequest(GET_SEARCH_VALUES_URL)
        setSearchValues(search.data)
        setLoading(false)

      } catch (error) {
        console.log(error)
        setLoading(false)
      }
    }
    GetData()
  }, [])
  const handleChange = (e) => {
    console.log(e)
    const name = e.target.name

    if (name === "city") {
      const value = JSON.parse(e.target.value)
      setSearchName((prev) => ({ ...prev, location: value.title }))
      setLoccation(value.id)
    } else if (name === "status") {
      const value = JSON.parse(e.target.value)
      if (value.title !== "any") {
        setSearchName((prev) => ({ ...prev, status: value.title }))
        setStatus(value.id)
      } else {
        setSearchName((prev) => ({ ...prev, status: "" }))
        setStatus("")
      }

    } else if (name === "type") {
      const value = JSON.parse(e.target.value)
      if (value.title !== "any") {
        setSearchName((prev) => ({ ...prev, type: value.title }))
        setType(value.id)
      } else {
        setSearchName((prev) => ({ ...prev, type: "" }))
        setType("")
      }

    } else if (name === "min_bed") {
      const value = JSON.parse(e.target.value)
      setSearchName((prev) => ({ ...prev, Min_Beds: value.title }))
      setMin_bed(value.id)
    } else if (name === "min_bath") {
      const value = JSON.parse(e.target.value)
      setSearchName((prev) => ({ ...prev, Min_Baths: value.title }))
      setMin_bath(value.id)
    } else if (name === "keyword") {
      setKeyword(e.target.value)
      setSearchName((prev) => ({
        ...prev,
        keyword: e.target.value
      }))
    }

  }

  const onSearch = async (e) => {
   e.preventDefault()
   const propertyData = document.getElementById("property-data")
   if (propertyData) {
       propertyData.scrollIntoView({ behavior: "instant" })
   }
    try{
      setLoading(true)
    const values ={
      ...( keyword!==""?{ keyword:keyword}:{}),
      ...( location!==""?{ location:location}:{}),
      ...( status!==""? {listing_status:status}:{}),
      ...( type!==""?{type:type}:{}),
      ...( price.length!==0? {min_price: price[0]}:{}),
      ...( price.length!==0? {max_price: price[1]}:{}),
      ...( area.length!==0? {min_size: area[0]}:{}),
      ...( area.length!==0? {max_size: area[1]}:{}),
       ...( min_bed!==""? {min_bed:min_bed}:{}),
       ...( min_bath!==""? {min_bath:min_bath}:{})
 
     } 
     const res = await PostRequest(GET_SEARCH_URL, values)
     setProperties(res)
     

    localStorage.setItem("mainSearchName", JSON.stringify(searchName))
    localStorage.setItem("mainSearchValue", JSON.stringify(values))
    const queryString = new URLSearchParams(searchName).toString();
    navigate(`/search?${queryString}`)
    setLoading(false)
   
  }catch(error){
    console.log(error)
  }
  }

  useEffect(() => {
   setSearchName(names)
    if(state!==null){
    if(state.location){
      setLoccation(state?.location)
    }
     if(state.status){
      setStatus(state?.status)
    }
     if(state.type){
      setType(state?.type)
    }
     if(state.price){
      setPrice(state.price)
    }
     if(state.area){
      setArea(state.area)
    }
     if(state.min_bed){
      setMin_bed(state?.min_bed)
    }
     if(state.min_bath){
      setMin_bath(state?.min_bath)
    }
     if(state.keyword){
      setKeyword(state?.keyword)
    }
  }
    const SearchData = async () => {
      try {
        setLoading(true)
        const data = {
          ...( state.keyword? {title: state.keyword}:{}),
          ...( state.type? {type_id: state.type}:{}),
          ...( state.min_bed? {min_bed: state.min_bed}:{}),
          ...( state.min_bath? {min_bath: state.min_bath}:{}),
          ...( state.price? {min_price: state.price[0]}:{}),
          ...( state.price? {max_price: state.price[1]}:{}),
          ...( state.area? {min_size: state.area[0]}:{}),
          ...( state.area? {max_size: state.area[1]}:{}),
          ...( state.location? {city_id: state.location}:{}),
          ...( state.status? {listing_status: state.status}:{})
        }
        const res = await PostRequest(`${GET_SEARCH_URL}?page=${currentPage}`, data)
        setProperties(res)
       setLoading(false)
       const propertyData = document.getElementById("property-data")
       if (propertyData) {
           propertyData.scrollIntoView({ behavior: "instant" })
       }
      } catch (error) {
        console.log(error)
      }
    }
    SearchData()
  }, [currentPage])



  return (
    <>
      <main className="page-content text-start">
        {/* Section Title Breadcrumbs*/}
        <section className="section-full section-full-mod-1">
          <div className="container">
            <div className="row">
              <div className="col-12">
                <h1>Search </h1>
                <p />
                <ol className="breadcrumb">
                  <li>
                  <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a>
                  </li>

                  <li className="active">Search</li>
                </ol>
              </div>
            </div>
          </div>
        </section>
        {/*Section Find your home*/}
        <section className="section-md section-bottom-0 bg-gray-dark">
          <div className="container position-margin-top">
            <div className="search-form-wrap bg-default container-shadow">
              <h3>Find Your Home</h3>
              <form className="form-variant-1" noValidate onSubmit={onSearch} name="search-form">
                <div className="form-wrap">
                  <label className="form-label" htmlFor="keyword">Keyword</label>
                  <input className="form-input" value={keyword} onChange={handleChange} id="keyword" type="text" name="keyword" placeholder="Any" />
                </div>
                <div className="form-wrap">
                  <label className="form-label" htmlFor="select-search-1">Location</label>
                  <select onChange={handleChange} name="city" className="form-input select-filter" id="select-search-1" data-minimum-results-for-search="Infinity">
                    <option selected value={JSON.stringify({ id: 0, title: "any" })} >Any</option>
                    {searchValues?.cities?.map((item) => (
                      <option key={item.id} selected={location === item.id} value={JSON.stringify({ id: item.id, title: item.name })} >{item.name}</option>
                    ))}

                  </select>
                </div>
                <div className="form-wrap">
                  <label className="form-label" htmlFor="select-search-2">Property Status</label>
                  <select onChange={handleChange} name="status" className="form-input select-filter" id="select-search-2" data-minimum-results-for-search="Infinity">
                    <option selected value={JSON.stringify({ id: 0, title: "any" })} >Any</option>
                    {searchValues?.listing_status?.map((item) => (

                      <option key={item.id} selected={status === item.id} value={JSON.stringify({ id: item.id, title: item.title })} >{item.title}</option>
                    ))}

                  </select>
                </div>
                <div className="form-wrap">
                  <label className="form-label" htmlFor="select-search-3">Property Type</label>
                  <select onChange={handleChange} name="type" className="form-input select-filter" id="select-search-3" data-minimum-results-for-search="Infinity">
                    <option selected value={JSON.stringify({ id: 0, title: "any" })} >Any</option>
                    {searchValues?.types?.map((item) => (

                      <option key={item.id} selected={type === item.id} value={JSON.stringify({ id: item.id, title: item.title })} >{item.title}</option>
                    ))}

                  </select>
                </div>
                <div className="form-wrap width-1"><span>Price (USD)<br /></span>
                  <div className="form-inline-flex-xs">
                    <input className="rd-range-input-value rd-range-input-value-1 form-input" id="range-1" type="text" name="range-2" value={price.length !==0? price[0]:400} /><span className="text-abbey dash">—</span>
                    <input className="rd-range-input-value rd-range-input-value-2 form-input" id="range-2" type="text" name="range-3"  value={ price.length !==0? price[1]:9000 } />
                  </div>
                  <RangeSlider className="mt-5 " value={price.length !==0?price:[400,9000]} name="price"
                    onChange={(e) => {
                      setPrice([e[0], e[1]])
                      setSearchName((prev) => ({
                        ...prev,
                        Min_Price: e[0],
                        Max_Price: e[1]
                      }))
                    }
                    } max={10000} min={100} />
                  {/* <input className="rd-range hasTooltip" data-min={100} data-max={10000} data-start="[600, 9500]" data-step={50} data-tooltip="true" data-min-diff={100} data-input=".rd-range-input-value-1" data-input-2=".rd-range-input-value-2" /> */}

                </div>
                <div className="form-wrap width-1"><span>Area (Sq Ft)<br /></span>
                  <div className="form-inline-flex-xs">
                    <input className="rd-range-input-value rd-range-input-value-3 form-input" id="range-3" type="text" name="range-2" value={ area.length!==0? area[0]:2000} /><span className="text-abbey dash">—</span>
                    <input className="rd-range-input-value rd-range-input-value-4 form-input" id="range-4" type="text" name="range-3" value={area.length!==0? area[1]:19000} />
                  </div>
                  <RangeSlider className="mt-5 " value={area.length!==0?area:[2000,19000]} onChange={(e) => {
                    setArea([e[0], e[1]])
                    setSearchName((prev) => ({
                      ...prev,
                      Min_Area: e[0],
                      Max_Area: e[1]
                    }))
                  }
                  } max={22000} min={500} />
                  {/* <input className="rd-range hasTooltip" type="range"  data-min={500} data-max={22000} data-start="[2000, 20000]" data-step={50} data-tooltip="true" data-min-diff={500} data-input=".rd-range-input-value-3" data-input-2=".rd-range-input-value-4" /> */}
                </div>
                <div className="form-wrap width-2">
                  <label className="form-label" htmlFor="select-search-7">Min Beds</label>
                  <select onChange={handleChange} name="min_bed" className="form-input select-filter" id="select-search-7" data-minimum-results-for-search="Infinity">
                    {searchValues?.min_bed?.map((item) => (

                      <option key={item.id} selected={min_bed === item.id} value={JSON.stringify({ id: item.id, title: item.title })} >{item.title}</option>
                    ))}

                  </select>
                </div>
                <div className="form-wrap width-2">
                  <label className="form-label" htmlFor="select-search-8">Min Baths</label>
                  <select onChange={handleChange} name="min_bath" className="form-input select-filter" id="select-search-8" data-minimum-results-for-search="Infinity">
                    {searchValues?.min_bath?.map((item) => (

                      <option key={item.id} selected={min_bath === item.id} value={JSON.stringify({ id: item.id, title: item.title })} >{item.title}</option>
                    ))}

                  </select>
                </div>
                <button className="btn btn-sm btn-sushi btn-min-width-sm">Search</button>
                {/* <div className="features ">
                  <a className={`btn-features ${showSearch ? 'active' : ""} `} onClick={() => { setShowSearch(!showSearch) }} >
                    <span />Look for certain features
                  </a>
                  <Animation.Collapse in={showSearch} >

                    <ul className="checkbox-list list-inline " style={{ display: showSearch ? "block" : "" }}  >
                      <li>
                        <label className="checkbox-inline">
                          <input className="checkbox-custom" name="input-group-radio" defaultValue="checkbox-1" type="checkbox" defaultChecked />
                          <span className="checkbox-custom-dummy"></span>
                          <span>Central Heating (7)</span>
                        </label>
                      </li>
                      <li>
                        <label className="checkbox-inline">
                          <input className="checkbox-custom" name="input-group-radio" defaultValue="checkbox-2" type="checkbox" />
                          <span className="checkbox-custom-dummy"></span>
                          <span>Lawn (6)</span>
                        </label>
                      </li>
                      <li>
                        <label className="checkbox-inline">
                          <input className="checkbox-custom" name="input-group-radio" defaultValue="checkbox-3" type="checkbox" />
                          <span className="checkbox-custom-dummy"></span>
                          <span>Marble Floors (8)</span>
                        </label>
                      </li>
                      <li>
                        <label className="checkbox-inline">
                          <input className="checkbox-custom" name="input-group-radio" defaultValue="checkbox-4" type="checkbox" />
                          <span className="checkbox-custom-dummy"></span>
                          <span>Fire Alarm (5)</span>
                        </label>
                      </li>
                      <li>
                        <label className="checkbox-inline">
                          <input className="checkbox-custom" name="input-group-radio" defaultValue="checkbox-5" type="checkbox" />
                          <span className="checkbox-custom-dummy"></span>
                          <span>Home Theater (3)</span>
                        </label>
                      </li>
                      <li>
                        <label className="checkbox-inline">
                          <input className="checkbox-custom" name="input-group-radio" defaultValue="checkbox-6" type="checkbox" />
                          <span className="checkbox-custom-dummy"></span>
                          <span>Hurricane Shutters (1)</span>
                        </label>
                      </li>
                    </ul>

                  </Animation.Collapse>
                </div> */}
              </form>
            </div>
          </div>
        </section>
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
              <div className="row" >
                <div className="col-12 col-xl-12" id="property-data" >
                  <div className="row clearleft-custom-5">
                    {properties?.data?.data?.map((item) => (
                      <div key={item.id} className="col-12 col-md-4">
                        <div className="thumbnail thumbnail-3" style={{position:"relative"}} >
                          <a className="img-link" onClick={() => navigate(`/property/${item.slug}`, { state: { propertyId: item.id } })} style={{ cursor: "pointer" }} >
                          <div className='badge bg-success p-2' style={{position:"absolute",zIndex:2,top:20,left:20 }} >
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
                totalRecords={properties?.data?.total}
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

export default Search