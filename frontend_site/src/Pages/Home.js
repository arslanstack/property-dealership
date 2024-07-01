import React, { useRef, useState, useEffect } from 'react'
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import Slider from "react-slick";
import { Animation, RangeSlider } from 'rsuite';
import { useNavigate } from 'react-router-dom';
import { GET_RECENT_URL, GET_TYPES_URL, GET_FEATURED_URL, GET_AGENTS_URL, GET_TESTIMONIALS_URL, GET_SEARCH_VALUES_URL } from '../Utils/URLs';
import { GetRequest } from '../Services/Api';
import { WordsEllipsis } from '../Components/Helper/Helper';
import PreLoading from '../Components/PreLoading/PreLoading';
const Home = () => {
  const [animating, setAnimating] = useState(true);
  const [currentSlide, setCurrentSlide] = useState(0);
  const [firstanimation, setFirstAnimation] = useState(true)
  const [showSearch, setShowSearch] = useState(false)
  const [price, setPrice] = useState([])
  const [area, setArea] = useState([])
  const [recentProperty, setRecentProperty] = useState([])
  const [types, setTypes] = useState([])
  const [featured, setFeatured] = useState([])
  const [loading, setLoading] = useState(true)
  const [agents, setAgents] = useState([])
  const [testimonials, setTestimonials] = useState([])
  const [searchValues, setSearchValues] = useState({})
  const [searchName, setSearchName] = useState({})
  const [keyword, setKeyword] = useState("")
  const [location,setLoccation] = useState("")
  const [status,setStatus] = useState("")
  const [type,setType] = useState("")
  const [min_bed,setMin_bed] = useState("")
  const [min_bath,setMin_bath] = useState("")

  const navigate = useNavigate()
  var settings = {
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    beforeChange: (current, next) => {
      setAnimating(false);
      setCurrentSlide(next);
      setFirstAnimation(false)
    },
    afterChange: (current) => {
      setFirstAnimation(true)
      setTimeout(() => {
        setAnimating(true);
      }, 900);
    },
  };
  var setting2 = {
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          initialSlide: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]

  }
  const sliderRef = useRef(null);


  useEffect(() => {
    const GetData = async () => {
      try {
        setLoading(true)
        const recent = await GetRequest(GET_RECENT_URL)
        setRecentProperty(recent.data)
        const types = await GetRequest(GET_TYPES_URL)
        setTypes(types.data)
        const featured = await GetRequest(GET_FEATURED_URL)
        setFeatured(featured.data)
        const agents = await GetRequest(GET_AGENTS_URL)
        setAgents(agents.data)
        const testimonial = await GetRequest(GET_TESTIMONIALS_URL)
        setTestimonials(testimonial.data)
        const search = await GetRequest(GET_SEARCH_VALUES_URL)
        setSearchValues(search.data)

        setLoading(false)
      } catch (error) {
        console.log(error)
      }
    }
    GetData()
    window.scrollTo({
      top: 0,
      behavior: "instant"
    })
  }, []);

 
  const handleChange = (e) => {
  
    const name = e.target.name

    if (name === "city") {
      const value = JSON.parse(e.target.value)
      setSearchName((prev) => ({ ...prev, location: value.title }))
      setLoccation(value.id)
    } else if (name === "status") {
      const value = JSON.parse(e.target.value)
      if(value.title !=="any"){
        setSearchName((prev) => ({ ...prev, status: value.title }))
        setStatus(value.id)
      }else{
        setSearchName((prev) => ({ ...prev, status: "" }))
        setStatus("")
      }
    
    } else if (name === "type") {
      const value = JSON.parse(e.target.value)
      if(value.title !=="any"){
        setSearchName((prev) => ({ ...prev, type: value.title }))
        setType(value.id)
      }else{
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
console.log(recentProperty)
  const onSearch = () => {
    const values ={
     ...( keyword!==""?{ keyword:keyword}:{}),
     ...( location!==""?{ location:location}:{}),
     ...( status!==""? {status:status}:{}),
     ...( type!==""?{type:type}:{}),
     ...( price.length!==0? {price:price}:{}),
     ...(area.length!==0? {area:area}:{}),
      ...( min_bed!==""? {min_bed:min_bed}:{}),
      ...( min_bath!==""? {min_bath:min_bath}:{})

    } 
    localStorage.setItem("mainSearchName",JSON.stringify(searchName))
    localStorage.setItem("mainSearchValue",JSON.stringify(values))
    const queryString = new URLSearchParams(searchName).toString();
    navigate(`/search?${queryString}`,{state:values})

  }
const handleNavigate = (id,title)=>{
 const names = {
  type:title
 }
  const values = {
    type:id
  }
  localStorage.setItem("mainSearchName",JSON.stringify(names))
  localStorage.setItem("mainSearchValue",JSON.stringify(values))
  const queryString = new URLSearchParams({type:title}).toString();
  navigate(`/search?${queryString}`,{state:values})
}
  return (
    <>
      {loading ? <PreLoading /> :
        <>
          <section className='mt-5 mt-md-0 ' >
            {/*Swiper*/}
            <div className="swiper-container swiper-slider swiper-vert-mid">
              {recentProperty.length !== 0 ?
                <Slider ref={sliderRef} {...settings}>
                  {recentProperty.map((item, index) => (
                    <div key={item.id} >
                      <div className="swiper-slide" style={{ backgroundImage: `url(${item.banner})` }} data-slide-bg="assets/images/slide-1.jpg">
                        <div className="swiper-slide-caption section-xs">
                          <div className="container">
                          
                            <div className={`swiper-caption-wrap  ${firstanimation ? 'animate__animated animate__fadeInDown opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeInDown">
                            <div className={`badge bg-success p-2 mb-2 ${animating && currentSlide === index ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} >
                              {item.listing_status}
                            </div>
                              <p className={`h3 ${animating && currentSlide === index ? 'animate__animated animate__fadeIn opacity-100' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>{item.title}</p>
                              <hr className={`${animating && currentSlide === index ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800} />
                              <p className={`d-none d-md-block ${animating && currentSlide === index ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>{item.address}</p>
                              <div className={`price text-ubold ${animating && currentSlide === index ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>${item.price}<span>{item.listing_type === "rent" ? `/${item.rent_cycle}` : ""}</span></div><a className={`btn btn-sm btn-sushi ${animating && currentSlide === index ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} style={{cursor:"pointer"}} onClick={()=>navigate("/contact_us",{state:{propertyId:item.id}})} data-caption-animate="fadeIn" data-caption-delay={800}>book now</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  ))}


                </Slider>

                :
                <Slider ref={sliderRef} {...settings}>

                  <div>
                    <div className="swiper-slide" style={{ backgroundImage: "url(assets/images/slide-1.jpg)" }} data-slide-bg="assets/images/slide-1.jpg">
                      <div className="swiper-slide-caption section-xs">
                        <div className="container">
                          <div className={`swiper-caption-wrap  ${firstanimation ? 'animate__animated animate__fadeInDown opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeInDown">
                            <p className={`h3 ${animating && currentSlide === 0 ? 'animate__animated animate__fadeIn opacity-100' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>1530-2 Liberty Ave 4</p>
                            <hr className={`${animating && currentSlide === 0 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800} />
                            <p className={`d-none d-md-block ${animating && currentSlide === 0 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>This is a 3 bedroom, 2.0 bathroom multi family home. It is located  at 1530 Liberty Ave Hillside.</p>
                            <div className={`price text-ubold ${animating && currentSlide === 0 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>$309.00<span>/day</span></div><a className={`btn btn-sm btn-sushi ${animating && currentSlide === 0 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} href="property-catalog-single.html" data-caption-animate="fadeIn" data-caption-delay={800}>book now</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div className="swiper-slide" style={{ backgroundImage: "url(assets/images/slide-2.jpg)" }} data-slide-bg="assets/images/slide-2.jpg">
                      <div className="swiper-slide-caption section-xs">
                        <div className="container">
                          <div className={`swiper-caption-wrap  ${firstanimation ? 'animate__animated animate__fadeInDown opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeInDown">
                            <p className={`h3 ${animating && currentSlide === 1 ? 'animate__animated animate__fadeIn opacity-100' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>53 Rachel Ct 53</p>
                            <hr className={`${animating && currentSlide === 1 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800} />
                            <p className={`d-none d-md-block ${animating && currentSlide === 1 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>A renovated apartment for rent by owner. 2 bedroom,  2 full bath living and dining room</p>
                            <div className={`price text-ubold ${animating && currentSlide === 1 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>$216.00<span>/day</span></div><a className={`btn btn-sm btn-sushi ${animating && currentSlide === 1 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} href="property-catalog-single.html" data-caption-animate="fadeIn" data-caption-delay={800}>book now</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div className="swiper-slide" style={{ backgroundImage: "url(assets/images/slide-3.jpg)" }} data-slide-bg="assets/images/slide-3.jpg">
                      <div className="swiper-slide-caption section-xs">
                        <div className="container">
                          <div className={`swiper-caption-wrap  ${firstanimation ? 'animate__animated animate__fadeInDown opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeInDown">
                            <p className={`h3 ${animating && currentSlide === 2 ? 'animate__animated animate__fadeIn opacity-100' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>Modera Loft</p>
                            <hr className={`${animating && currentSlide === 2 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800} />
                            <p className={`d-none d-md-block ${animating && currentSlide === 2 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>Make Modera Loft your home and reside in historic Jersey City style.</p>
                            <div className={`price text-ubold ${animating && currentSlide === 2 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} data-caption-animate="fadeIn" data-caption-delay={800}>$239.00<span>/day</span></div><a className={`btn btn-sm btn-sushi ${animating && currentSlide === 2 ? 'animate__animated animate__fadeIn opacity-100 ' : "opacity-0"}`} href="property-catalog-single.html" data-caption-animate="fadeIn" data-caption-delay={800}>book now</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </Slider>
              }

              {/* Swiper Navigation*/}
              <div className="swiper-button-prev" onClick={() => { sliderRef.current.slickPrev(); setFirstAnimation(true) }} />
              <div className="swiper-button-next" onClick={() => { sliderRef.current.slickNext(); setFirstAnimation(true) }} />
            </div>
          </section>


          <main className="page-content">
            {/*Section Find your home*/}
            <section className="section-md section-bottom-0 bg-gray-dark">
              <div className="container position-margin-top">
                <div className="search-form-wrap bg-default container-shadow">
                  <h3>Find Your Home</h3>
                  <form className="form-variant-1" onSubmit={onSearch} name="search-form">
                    <div className="form-wrap">
                      <label className="form-label" htmlFor="keyword">Keyword</label>
                      <input className="form-input" value={keyword} onChange={handleChange} id="keyword" type="text" name="keyword" placeholder="Any" />
                    </div>
                    <div className="form-wrap">
                      <label className="form-label" htmlFor="select-search-1">Location</label>
                      <select onChange={handleChange} name="city" className="form-input select-filter" id="select-search-1" data-minimum-results-for-search="Infinity">
                      <option selected value={JSON.stringify({id:0,title:"any"})} >Any</option>
                        {searchValues?.cities?.map((item) => (
                          <option key={item.id} value={JSON.stringify({ id: item.id, title: item.name })} >{item.name}</option>
                        ))}

                      </select>
                    </div>
                    <div className="form-wrap">
                      <label className="form-label" htmlFor="select-search-2">Property Status</label>
                      <select onChange={handleChange} name="status" className="form-input select-filter" id="select-search-2" data-minimum-results-for-search="Infinity">
                      <option selected value={JSON.stringify({id:0,title:"any"})} >Any</option>
                        {searchValues?.listing_status?.map((item) => (

                          <option key={item.id} value={JSON.stringify({ id: item.id, title: item.title })} >{item.title}</option>
                        ))}

                      </select>
                    </div>
                    <div className="form-wrap">
                      <label className="form-label" htmlFor="select-search-3">Property Type</label>
                      <select onChange={handleChange} name="type" className="form-input select-filter" id="select-search-3" data-minimum-results-for-search="Infinity">
                      <option selected value={JSON.stringify({id:0,title:"any"})} >Any</option>
                        {searchValues?.types?.map((item) => (

                          <option key={item.id} value={JSON.stringify({ id: item.id, title: item.title })} >{item.title}</option>
                        ))}

                      </select>
                    </div>
                    <div className="form-wrap width-1"><span>Price (USD)<br /></span>
                      <div className="form-inline-flex-xs">
                        <input className="rd-range-input-value rd-range-input-value-1 form-input" id="range-1" type="text" name="range-2" value={price.length !==0? price[0]:400} /><span className="text-abbey dash">—</span>
                        <input className="rd-range-input-value rd-range-input-value-2 form-input" id="range-2" type="text" name="range-3" value={ price.length !==0? price[1]:9000 } />
                      </div>
                      <RangeSlider className="mt-5 " defaultValue={[400,9000]} value={price.length !==0?price:[400,9000]} name="price" 
                      onChange={(e)=>{
                        setPrice([e[0],e[1]])
                        setSearchName((prev)=>({
                          ...prev,
                          Min_Price:e[0],
                          Max_Price:e[1]
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
                      <RangeSlider className="mt-5 " defaultValue={[2000,19000]} value={area.length!==0?area:[2000,19000]}  onChange={(e)=>{
                        setArea([e[0],e[1]])
                        setSearchName((prev)=>({
                          ...prev,
                          Min_Area:e[0],
                          Max_Area:e[1]
                        }))
                      }
                       } max={22000} min={500} />
                      {/* <input className="rd-range hasTooltip" type="range"  data-min={500} data-max={22000} data-start="[2000, 20000]" data-step={50} data-tooltip="true" data-min-diff={500} data-input=".rd-range-input-value-3" data-input-2=".rd-range-input-value-4" /> */}
                    </div>
                    <div className="form-wrap width-2">
                      <label className="form-label" htmlFor="select-search-7">Min Beds</label>
                      <select onChange={handleChange} name="min_bed" className="form-input select-filter" id="select-search-7" data-minimum-results-for-search="Infinity">
                        {searchValues?.min_bed?.map((item) => (

                          <option key={item.id} value={JSON.stringify({ id: item.id, title: item.title })} >{item.title}</option>
                        ))}

                      </select>
                    </div>
                    <div className="form-wrap width-2">
                      <label className="form-label" htmlFor="select-search-8">Min Baths</label>
                      <select onChange={handleChange} name="min_bath" className="form-input select-filter" id="select-search-8" data-minimum-results-for-search="Infinity">
                        {searchValues?.min_bath?.map((item) => (

                          <option key={item.id} value={JSON.stringify({ id: item.id, title: item.title })} >{item.title}</option>
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
            {/*Section popular categories 1*/}
            <section className="section-lg text-center text-md-start bg-gray-dark home-category ">
              <div className="container">
                <h2>Popular categories</h2>
                <hr />
                <div className="row offset-custom-11">
                  {types.slice(0, 4).map((item) => (
                    <div key={item.id} className="col-12 col-md-6">
                      <a className="img-thumbnail-variant-1" style={{cursor:"pointer"}} onClick={()=>handleNavigate(item.id,item.title)}>
                        <img src={item.banner} alt="" width={570} height={"600px"} />
                        <div className="caption">
                          <h4 className="text-white">{item.title}</h4>
                          <p>{item.property_count} properties</p>
                        </div></a></div>
                  ))}

                  {/* <div className="col-12 col-md-6"><a className="img-thumbnail-variant-1" href="property-catalog-single.html"><img src="assets/images/categories-2.jpg" alt="" width={570} height={380} />
                  <div className="caption">
                    <h4 className="text-white">Luxury Houses</h4>
                    <p>36 properties</p>
                  </div></a></div>
              <div className="col-12 col-md-6"><a className="img-thumbnail-variant-1" href="property-catalog-single.html"><img src="assets/images/categories-3.jpg" alt="" width={570} height={380} />
                  <div className="caption">
                    <h4 className="text-white">Cozy Houses</h4>
                    <p>61 properties</p>
                  </div></a></div>
              <div className="col-12 col-md-6"><a className="img-thumbnail-variant-1" href="property-catalog-single.html"><img src="assets/images/categories-4.jpg" alt="" width={570} height={380} />
                  <div className="caption">
                    <h4 className="text-white">With Swimming Pool</h4>
                    <p>24 properties</p>
                  </div></a></div> */}
                </div>
              </div>
            </section>
            {/*Section Recent Properties*/}
            <section className="section-lg text-center text-md-start">
              <div className="container">
                <h2>Featured Properties</h2>
                <hr />
                <div className="row clearleft-custom">
                  {featured.map((item) => (
                    <div key={item.id} className="col-12 col-md-4">
                      <div className="thumbnail thumbnail-3" style={{position:"relative"}} >
                        <a className="img-link" style={{ cursor: "pointer" }} onClick={() => navigate(`/property/${item.slug}`, { state: { propertyId: item.id } })}>
                          <div className='badge bg-success p-2' style={{position:"absolute",zIndex:2,top:20,left:20 }} >
                            {item.listing_status}
                          </div>
                          <img
                            src={item.banner}
                            alt=""
                            width={370}
                            height={250}
                            style={{ width: 370, height: 250 }}
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
                          <p className="text-abbey" >
                            < div dangerouslySetInnerHTML={{ __html: item.description }} />
                          </p>
                        </div>
                      </div>
                    </div>
                  ))}


                </div><a className="btn btn-sm btn-sushi offset-custom-11" onClick={() => navigate("/property")} >view all properties</a>
              </div>
            </section>
            {/*Section Our Advantages*/}
            <section className="section-lg bg-gray text-center text-lg-start">
              <div className="container">
                <h2>Our Advantages</h2>
                <hr />
                <div className="row flow-offset-8">
                  <div className="col-md-6 col-lg-3">
                    <div className="media media-mod-6">
                      <div className="media-left"><span className="linecons-location4 icon icon-lg bg-accent" /></div>
                      <div className="media-body">
                        <h4>Various Locations</h4>
                        <p>Search by state then by city to find an apartment  overlooking the lake in Chicago, within walking distance of the beach in Los Angeles or in the heart of Atlanta.</p>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-6 col-lg-3">
                    <div className="media media-mod-6">
                      <div className="media-left"><span className="linecons-camera7 icon icon-lg bg-accent" /></div>
                      <div className="media-body">
                        <h4>View Apartments</h4>
                        <p>View apartment listings with photos, HD videos, InsideView virtual tours, 3D floor plans, and more, while also choosing the apartment and community features that you want.</p>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-6 col-lg-3">
                    <div className="media media-mod-6">
                      <div className="media-left"><span className="linecons-blockade icon icon-lg bg-accent" /></div>
                      <div className="media-body">
                        <h4>Privacy and Security</h4>
                        <p>Renters insurance helps keep your belongings secure, whether they're on your desk, under your couch, or in some cases, even in your car's glove box.</p>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-6 col-lg-3">
                    <div className="media media-mod-6">
                      <div className="media-left"><span className="linecons-banknote icon icon-lg bg-accent" /></div>
                      <div className="media-body">
                        <h4>No Commission</h4>
                        <p>You will therefore appreciate this opportunity to acquire a high-quality apartment for rent without having to pay any commission to our real estate agency.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            {/*Section our team*/}
            <section className="section-lg">
              <div className="container">
                <h2>Our Real Estate Agents</h2>
                <hr />
                {/* Owl Carousel*/}
                <div className='pt-5 pb-5' >
                  <Slider {...setting2} >
                    {agents.map((item) => (
                      <div className="team-member pb-4 " key={item.id} >
                        <div className="media media-mod-3">
                          <div className="media-left img-width-auto"><img src={item.image} alt="" style={{ width: 100, height: 100 }} width={100} height={100} /></div>
                          <div className="media-body">
                            <h5 className="text-sushi">{item.name}</h5>
                            <p>{item.designation}</p>
                            <dl className="dl-horizontal-mod-1 text-ubold text-abbey">
                              <dt>tel.</dt>
                              <dd><a href="callto:#">{item.phone}</a></dd>
                            </dl>
                          </div>
                        </div>
                        <p>{item.description}</p>
                        {/* <a className="btn btn-sm btn-primary" href="agent-personal.html">Get in touch</a> */}
                      </div>
                    ))}


                  </Slider>
                </div>
              </div>
            </section>
            {/*Section Testimonials*/}
            <section className="section-lg text-center text-md-start bg-clients">
              <div className="container">
                <h2 className="text-white">Testimonials</h2>
                <hr />
                {/* Owl Carousel*/}
                <div className="row flow-offset-1 clearleft-custom-2">
                  {testimonials.slice(0, 4).map((item) => (
                    <div key={item.id} className="col-12 col-md-6">
                      <blockquote className="quote">
                        <div className="img-wrap"><img src={item.image} alt="" width={50} height={50} style={{ height: 50, width: 50 }} /></div>
                        <cite className="text-start"><span className="h6 text-primary text-ubold">{item.name}</span><span className="text-lightest">{item.designation}</span></cite>
                        <p>
                          <q className="text-white">{item.content}</q>
                        </p>
                      </blockquote>
                    </div>
                  ))}

                  {/* <div className="col-12 col-md-6">
                    <blockquote className="quote">
                      <div className="img-wrap"><img src="assets/images/index-17.jpg" alt="" width={50} height={50} /></div>
                      <cite className="text-start"><span className="h6 text-primary text-ubold">Richard Santos</span><span className="text-lightest">Web Designer, New York</span></cite>
                      <p>
                        <q>I just don't know how to describe your services... They are extraordinary! I am quite happy with them! Just keep up going this way!</q>
                      </p>
                    </blockquote>
                  </div>
                  <div className="col-12 col-md-6">
                    <blockquote className="quote">
                      <div className="img-wrap"><img src="assets/images/index-18.jpg" alt="" width={50} height={50} /></div>
                      <cite className="text-start"><span className="h6 text-primary text-ubold">Diana Valdez</span><span className="text-lightest">Teacher, San Diego</span></cite>
                      <p>
                        <q>Thank you very much. I'm impressed with your service. I've already told my friends about your company and your quick response, thanks again!</q>
                      </p>
                    </blockquote>
                  </div>
                  <div className="col-12 col-md-6">
                    <blockquote className="quote">
                      <div className="img-wrap"><img src="assets/images/client-1.jpg" alt="" width={50} height={50} /></div>
                      <cite className="text-start"><span className="h6 text-primary text-ubold">George Ortega</span><span className="text-lightest">Manager, New York</span></cite>
                      <p>
                        <q>Great organization! Your prompt answer became a pleasant surprise for me. You`ve rendered an invaluable service! Thank you very much!</q>
                      </p>
                    </blockquote>
                  </div> */}
                  <div className="col-12"><a className="btn btn-sushi btn-sm" onClick={() => navigate("/client-testimonials")} style={{ cursor: "pointer" }} >read more testimonials</a></div>
                </div>
              </div>
            </section>
          </main>
        </>
      }
    </>
  )
}

export default Home