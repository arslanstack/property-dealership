import React, { useState, useEffect } from 'react'
import { useNavigate, useLocation } from 'react-router-dom'
import { GET_NEIGHBORS_URL, GET_CITIES_URL } from '../../Utils/URLs'
import { GetRequest } from '../../Services/Api'
const Header = () => {

  const [buyingFocus, setBuyingFocus] = useState(false)
  const [sellingFocus, setSellingFocus] = useState(false)
  const [extraFocus, setExtraFocus] = useState(false)
  const [bajaResFocus, setBajaResFocus] = useState(false)
  const [neighborFocus, setNeighborFocus] = useState(false)
  const [blogFocus, setBlogFocus] = useState(false)
  const [contactFocus, setContactFocus] = useState(false)
  const [sideNav, setSideNav] = useState(false)
  const [isMediumScreen, setIsMediumScreen] = useState(false);

  const navigate = useNavigate()
  const { pathname } = useLocation()
  const [neighbors, setNeighbors] = useState([])
  const [cities, setCities] = useState([])

  useEffect(() => {
    const GetData = async () => {
      try {
        const res = await GetRequest(GET_NEIGHBORS_URL)
        setNeighbors(res.data)
        const city = await GetRequest(GET_CITIES_URL)
        setCities(city.data)
      } catch (error) {
        console.log(error)
      }
    }
    GetData()
    const handleResize = () => {
      setIsMediumScreen(window.innerWidth <= 768);
    };
    handleResize();
    window.addEventListener('resize', handleResize);
    return () => {
      window.removeEventListener('resize', handleResize);
    };
  }, []);




  return (
    <>
      <div >
        <header className="page-head">
          {/* RD Navbar*/}
          <div className="rd-navbar-wrap header_corporate">
            <nav className={`rd-navbar rd-navbar-original ${isMediumScreen ? 'rd-navbar-fixed' : 'rd-navbar-fullwidth'}`} data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-device-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-stick-up-offset="100px">
              {/*RD Navbar Panel*/}
              <div className="rd-navbar-top-panel d-none d-md-block ">
                <div className="rd-navbar-top-panel-wrap">
                  <dl className="dl-horizontal-mod-1 login">
                    <dt><span className="mdi mdi-login icon-xxs-mod-2" /></dt>
                    <dd><a className="text-sushi" style={{cursor:"pointer"}} onClick={()=>navigate("/login")}> Login</a></dd>
                  </dl>
                  <div className="top-panel-inner  ">
                    <dl className="dl-horizontal-mod-1">
                      <dt><span className="material-icons-local_phone icon-xxs-mod-2" /></dt>
                      <dd><a href="callto:#"> +1 310-706-2585</a></dd>
                    </dl>
                    <dl className="dl-horizontal-mod-1">
                      <dt><span className="material-icons-drafts icon-xxs-mod-2" /></dt>
                      <dd><a href="mailto:#"> ra@mybajaproperty.com</a></dd>
                    </dl>
                    {/* <address>
                    <dl className="dl-horizontal-mod-1">
                      <dt><span className="mdi mdi-map-marker-radius icon-xxs-mod-2" /></dt>
                      <dd><a className="inset-11" href="#">795 Folsom Ave, Suite 600 San Francisco, CA 94107</a></dd>
                    </dl>
                  </address> */}
                  </div>
                  <ul className="list-inline">
                    <li><a className="fa-facebook" href="https://www.facebook.com/ronNaurybaja" target="_blank" /></li>
                    <li><a className="fa-instagram" href="https://www.instagram.com/Ron_N_Aury/" target="_blank" /></li>
                    <li><a className="fa-pinterest-p" href="https://www.pinterest.com.mx/Ron_N_Aury/" target="_blank" /></li>
                    <li><a className="fa-youtube" href="https://www.youtube.com/watch?v=kcnBy2ACpU4&list=PLR-iLi35L5xvIC_C2puE2taA9YYv71Ndj" target="_blank" /></li>
                    <li><a className="fa-tiktok" href="https://www.tiktok.com/@ron_n_aury" target="_blank" /></li>
                    {/* <li><a className="fa-rss" href="#" /></li> */}
                  </ul>
                  <div className="btn-group"><a className="btn btn-sm btn-primary" onClick={()=>navigate("/contact_us")} style={{cursor:"pointer"}} >Contact Us</a></div>
                </div>
              </div>
              <div className="rd-navbar-inner inner-wrap   ">
                <div className="rd-navbar-panel d-flex d-md-inline-block ">
                  {/* RD Navbar Toggle*/}
                  <button className={`rd-navbar-toggle d-block d-md-none ${sideNav ? 'active' : ""}`} onClick={() => setSideNav(!sideNav)} data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span /></button>
                  {/* RD Navbar Brand*/}
                  <div className="rd-navbar-brand"><a className="brand-name" href="/"><img src="/assets/images/logomybp.png" alt="" style={{ height: 60 }} /></a></div>
                </div>
                <div className="btn-group d-none d-md-block " style={{ marginTop: 9 }} ><a className="btn btn-sm btn-primary" style={{cursor:"pointer"}} onClick={()=>navigate("/contact_us")}  >Contact us</a></div>
                <div className="rd-navbar-nav-wrap d-none d-md-block  ">
                  {/* RD Navbar Nav*/}
                  <ul className="rd-navbar-nav">
                    <li className={pathname === "/" ? "active" : ""} ><a style={{ cursor: "pointer" }} onClick={() => navigate("/")}>Home</a></li>
                    <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${buyingFocus ? 'focus' : ""}`} onMouseOver={() => setBuyingFocus(true)} onMouseOut={() => setBuyingFocus(false)} ><a href="#">Buying</a>
                      <span className="rd-navbar-submenu-toggle"></span>
                      {/* RD Navbar Dropdown*/}
                      <ul className="rd-navbar-dropdown rd-navbar-open-right">
                        {cities.map((item) => (

                          <li><a href style={{ cursor: "pointer" }} onClick={() => {
                            navigate(`/city/${item.slug}`, { state: { cityId: item.id } })

                          }} >{item.name}</a></li>
                        ))}

                      </ul>
                    </li>
                    <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${sellingFocus ? 'focus' : ""}`} onMouseOver={() => setSellingFocus(true)} onMouseOut={() => setSellingFocus(false)}><a href="#">Selling</a>
                      {/* RD Navbar Dropdown*/}
                      <span className="rd-navbar-submenu-toggle"></span>
                      <ul className="rd-navbar-dropdown">
                        <li><a style={{ cursor: "pointer" }} onClick={() => navigate("/the-right-selling-price")} >The Right Selling Price</a></li>
                        <li><a style={{ cursor: "pointer" }} onClick={() => navigate("/surviving-the-sale")}  >Survivng The Sale</a></li>
                        {/* <li><a href="#">Relocation Check List</a></li>
                        <li><a href="#">Preparing Your Home For Sale</a></li>
                        <li><a href="#">Selling Your Home</a></li> */}
                        <li><a  style={{ cursor: "pointer" }} onClick={()=>navigate("/tips-for-increasing-your-homes-appeal-exterior")} >Tips For Increasing Your Home's Appeal: Exterior</a></li>
                        <li><a  style={{ cursor: "pointer" }}  onClick={()=>navigate("/tips-for-increasing-your-homes-appeal-interior")} >Tips For Increasing Your Home's Appeal: Interiors</a></li>
                        <li><a  style={{ cursor: "pointer" }}  onClick={()=>navigate("/common-home-selling-mistakes-and-how-to-avoid-them")} >5 Most Common Selling Mistakes</a></li>
                        <li><a style={{ cursor: "pointer" }} onClick={()=>navigate("/client-testimonials")} >Client Testimonials</a></li>
                      </ul>
                    </li>
                    <li className={pathname === "/rentals" ? "active" : ""} ><a style={{ cursor: "pointer" }} onClick={() => navigate("/rentals")} >Rentals</a>

                    </li>
                    <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${bajaResFocus ? 'focus' : ""}`} onMouseOver={() => setBajaResFocus(true)} onMouseOut={() => setBajaResFocus(false)} ><a href="#">Baja Resources</a>
                      <span className="rd-navbar-submenu-toggle"></span>
                      <ul className="rd-navbar-dropdown">
                        <li><a style={{ cursor: "pointer" }} onClick={() => navigate("/home-evaluation")}>Home Evaluation</a></li>
                      </ul>
                    </li>
                    <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${neighborFocus ? 'focus' : pathname.includes("neighborhood")?"active":""}`} onMouseOver={() => setNeighborFocus(true)} onMouseOut={() => setNeighborFocus(false)}><a href="#">Neighborhoods</a>
                      <span className="rd-navbar-submenu-toggle"></span>
                      {/* RD Navbar Megamenu*/}
                      <ul className="rd-navbar-dropdown">

                        {neighbors.map((item) => (
                          <li className={pathname.includes(item.slug) ? "active" : ""} ><a style={{ cursor: "pointer" }} onClick={() => navigate(`neighborhood/${item.slug}`, { state: { neighborId: item.id } })}>{item.title}</a></li>
                        ))}

                        {/* <li><a href="our-team.html">Club Marena</a></li>
                          <li><a href="agent-personal.html">Costa Bella</a></li> */}



                      </ul>
                    </li>
                    <li><a onClick={()=>navigate("/border-wait-times")} style={{cursor:"pointer"}}>Border Update</a>
                    </li>
                    <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${contactFocus ? 'focus' : ""}`} onMouseOver={() => setContactFocus(true)} onMouseOut={() => setContactFocus(false)} ><a href="#">Contact Us</a>
                      <span className="rd-navbar-submenu-toggle"></span>
                      <ul className="rd-navbar-dropdown">
                        <li><a style={{ cursor: "pointer" }} onClick={() => navigate("/contact_us")} >Contact</a></li>
                        <li><a href="gallery-2.html">About us</a></li>
                        <li><a onClick={() => navigate("/client-testimonials")} style={{ cursor: "pointer" }} >Client Testimonials</a></li>
                      </ul>
                    </li>
                    <li className="link-group"><a className="btn btn-sm btn-primary" onClick={()=>navigate("/contact_us")} style={{cursor:"pointer"}} >Contact Us</a></li>
                    <li className="rd-navbar-bottom-panel">
                      {/* <div className="rd-navbar-bottom-panel-wrap">
                        <dl className="dl-horizontal-mod-1 login">
                          <dt><span className="mdi mdi-login icon-xxs-mod-2" /></dt>
                          <dd><a className="text-sushi" href="login.html"> Login</a></dd>
                        </dl>
                        <div className="top-panel-inner">
                          <dl className="dl-horizontal-mod-1">
                            <dt><span className="icon-xxs-mod-2 material-icons-local_phone" /></dt>
                            <dd><a href="callto:#"> 1-800-1234-567</a></dd>
                          </dl>
                          <dl className="dl-horizontal-mod-1">
                            <dt><span className="material-icons-drafts icon-xxs-mod-2" /></dt>
                            <dd><a href="mailto:#"> info@demolink.org</a></dd>
                          </dl>
                          <address>
                            <dl className="dl-horizontal-mod-1">
                              <dt><span className="icon-xxs-mod-2 mdi mdi-map-marker-radius" /></dt>
                              <dd><a className="inset-11" href="#">795 Folsom Ave, Suite 600 San Francisco, CA 94107</a></dd>
                            </dl>
                          </address>
                        </div>
                        <ul className="list-inline">
                          <li><a className="fa-facebook" href="#" /></li>
                          <li><a className="fa-twitter" href="#" /></li>
                          <li><a className="fa-pinterest-p" href="#" /></li>
                          <li><a className="fa-vimeo" href="#" /></li>
                          <li><a className="fa-google" href="#" /></li>
                          <li><a className="fa-rss" href="#" /></li>
                        </ul>
                      </div> */}
                    </li>
                  </ul>
                </div>
              </div>

              <div className={`rd-navbar-nav-wrap toggle-original-elements d-block d-md-none  ${sideNav ? 'active' : ""}  `}>
                {/* RD Navbar Nav*/}
                <ul className="rd-navbar-nav">
                  <li className={pathname === "/" ? "active" : ""} ><a style={{ cursor: "pointer" }} onClick={() => navigate("/")}>Home</a></li>
                  <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${buyingFocus ? 'opened' : ""}`} onClick={() => setBuyingFocus(!buyingFocus)} ><a href="#">Buying</a>
                    <span className="rd-navbar-submenu-toggle"></span>
                    {/* RD Navbar Dropdown*/}
                    <ul className="rd-navbar-dropdown rd-navbar-open-right">
                      {cities.map((item) => (

                        <li><a href style={{ cursor: "pointer" }} onClick={() => {
                          navigate(`/city/${item.slug}`, { state: { cityId: item.id } })

                        }} >{item.name}</a></li>
                      ))}


                    </ul>
                  </li>
                  <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${sellingFocus ? 'opened' : ""}`} onClick={() => setSellingFocus(!sellingFocus)}><a href="#">Selling</a>
                    {/* RD Navbar Dropdown*/}
                    <span className="rd-navbar-submenu-toggle"></span>
                    <ul className="rd-navbar-dropdown">
                    <li><a style={{ cursor: "pointer" }} onClick={() => navigate("/the-right-selling-price")} >The Right Selling Price</a></li>
                        <li><a style={{ cursor: "pointer" }} onClick={() => navigate("/surviving-the-sale")}  >Survivng The Sale</a></li>
                        {/* <li><a href="#">Relocation Check List</a></li>
                        <li><a href="#">Preparing Your Home For Sale</a></li>
                        <li><a href="#">Selling Your Home</a></li> */}
                        <li><a  style={{ cursor: "pointer" }} onClick={()=>navigate("/tips-for-increasing-your-homes-appeal-exterior")} >Tips For Increasing Your Home's Appeal: Exterior</a></li>
                        <li><a  style={{ cursor: "pointer" }}  onClick={()=>navigate("/tips-for-increasing-your-homes-appeal-interior")} >Tips For Increasing Your Home's Appeal: Interiors</a></li>
                        <li><a  style={{ cursor: "pointer" }}  onClick={()=>navigate("/common-home-selling-mistakes-and-how-to-avoid-them")} >5 Most Common Selling Mistakes</a></li>
                        <li><a style={{ cursor: "pointer" }} onClick={()=>navigate("/client-testimonials")} >Client Testimonials</a></li>
                    </ul>
                  </li>
                  <li className={pathname === "/rentals" ? "active" : ""} ><a style={{ cursor: "pointer" }} onClick={() => navigate("/rentals")} >Rentals</a>

                  </li>
                  <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${bajaResFocus ? 'opened' : ""}`} onClick={() => setBajaResFocus(!bajaResFocus)} ><a href="#">Baja Resources</a>
                    <span className="rd-navbar-submenu-toggle"></span>
                    <ul className="rd-navbar-dropdown">
                      <li><a style={{ cursor: "pointer" }} onClick={() => navigate("/home-evaluation")}>Home Evaluation</a></li>
                    </ul>
                  </li>
                  <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${neighborFocus ? 'opened' : ""}`} onClick={() => setNeighborFocus(!neighborFocus)} ><a href="#">Neighborhoods</a>
                    <span className="rd-navbar-submenu-toggle"></span>
                    {/* RD Navbar Megamenu*/}
                    <ul className="rd-navbar-dropdown">


                    {neighbors.map((item) => (
                          <li><a style={{ cursor: "pointer" }} onClick={() => navigate(`neighborhood/${item.slug}`, { state: { neighborId: item.id } })}>{item.title}</a></li>
                        ))}



                    </ul>
                  </li>
                  <li><a  onClick={()=>navigate("/border-wait-times")} style={{cursor:"pointer"}} >Border Update</a>
                  </li>
                  <li className={`rd-navbar--has-dropdown rd-navbar-submenu ${contactFocus ? 'opened' : ""}`} onClick={() => setContactFocus(!contactFocus)}  ><a href="#">Contact Us</a>
                    <span className="rd-navbar-submenu-toggle"></span>
                    <ul className="rd-navbar-dropdown">
                      <li><a style={{ cursor: "pointer" }} onClick={() => navigate("/contact_us")} >Contact</a></li>
                      <li><a href="gallery-2.html">About us</a></li>
                      <li><a onClick={() => navigate("/client-testimonials")} style={{ cursor: "pointer" }} >Client Testimonials</a></li>
                    </ul>
                  </li>
                  <li className="link-group"><a className="btn btn-sm btn-primary" href="submit-property.html">Contact us</a></li>
                  {/* <li className="rd-navbar-bottom-panel">
                    <div className="rd-navbar-bottom-panel-wrap">
                      <dl className="dl-horizontal-mod-1 login">
                        <dt><span className="mdi mdi-login icon-xxs-mod-2" /></dt>
                        <dd><a className="text-sushi" href="login.html"> Login/Registration</a></dd>
                      </dl>
                      <div className="top-panel-inner">
                        <dl className="dl-horizontal-mod-1">
                          <dt><span className="icon-xxs-mod-2 material-icons-local_phone" /></dt>
                          <dd><a href="callto:#"> 1-800-1234-567</a></dd>
                        </dl>
                        <dl className="dl-horizontal-mod-1">
                          <dt><span className="material-icons-drafts icon-xxs-mod-2" /></dt>
                          <dd><a href="mailto:#"> info@demolink.org</a></dd>
                        </dl>
                        <address>
                          <dl className="dl-horizontal-mod-1">
                            <dt><span className="icon-xxs-mod-2 mdi mdi-map-marker-radius" /></dt>
                            <dd><a className="inset-11" href="#">795 Folsom Ave, Suite 600 San Francisco, CA 94107</a></dd>
                          </dl>
                        </address>
                      </div>
                      <ul className="list-inline">
                        <li><a className="fa-facebook" href="#" /></li>
                        <li><a className="fa-twitter" href="#" /></li>
                        <li><a className="fa-pinterest-p" href="#" /></li>
                        <li><a className="fa-vimeo" href="#" /></li>
                        <li><a className="fa-google" href="#" /></li>
                        <li><a className="fa-rss" href="#" /></li>
                      </ul>
                    </div>
                  </li> */}
                </ul>
              </div>

            </nav>
          </div>
        </header>
      </div>
    </>
  )
}

export default Header