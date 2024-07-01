import React, { useEffect, useRef, useState } from 'react'
import { GetRequest,PostRequest } from '../Services/Api'
import { CONTACT_US_URL, GET_PROPERTY_OPTIONS_URL } from '../Utils/URLs'
import PreLoading from '../Components/PreLoading/PreLoading'
import { yupResolver } from '@hookform/resolvers/yup'
import { ContactSchema } from '../Utils/Validations'
import { useForm, Controller } from 'react-hook-form'
import PhoneInput from 'react-phone-input-2'
import 'react-phone-input-2/lib/style.css'
import $ from "jquery"
import toast, { Toaster } from 'react-hot-toast';
import { useLocation } from 'react-router-dom'
import { useNavigate } from 'react-router-dom'
import Properties from './Properties'
const ContactUs = () => {
    const [loading, setLoading] = useState(true)
    const {state} = useLocation()
    const [propertyOptions, setPropertyOptions] = useState([])
    const [formBusy,setFormBusy] = useState(false)
    const navigate = useNavigate()
    const propertyRef = useRef(null)
    const { handleSubmit, control, formState: { errors },setValue,reset } = useForm({
        resolver: yupResolver(ContactSchema)
    })
    useEffect(() => {
        const GetData = async () => {
            try {
                const res = await GetRequest(GET_PROPERTY_OPTIONS_URL)
                setPropertyOptions(res.data)
                setLoading(false)
            } catch (error) {
                console.log(error)
                setLoading(false)
            }
        }
        GetData()
    }, [])

    useEffect(() => {
        if(state!==null){
            setValue("property_id",[state.propertyId])
        }
        if (propertyRef !== null) {
            $(propertyRef.current).select2({
                theme: "bootstrap"
            });
            console.log($(propertyRef.current))
            $(propertyRef.current).on("change", function () {
                const selectedValue = $(this).val();
                console.log(selectedValue)
                setValue("property_id", selectedValue)

            });
            return () => {
                $(propertyRef.current).select2("destroy")
            }
        }
    }, [loading,state])

    const onSubmit = async(e) =>{
        const defaultValue = {
            name:"",
            email:"",
            phone:"",
            property_id:"",
            message:""
        }
        setFormBusy(true)
        console.log(e)
        const data = {
            ...e,
            property_id:JSON.stringify(e.property_id)
        }
        const res = await PostRequest(CONTACT_US_URL,data)
        toast.success(res.message,{
            position:"top-right",
            duration:4000
        })
        reset(defaultValue)
        setFormBusy(false)
    }


    return (
        <>
        <Toaster />
            {loading && <PreLoading />}

            <main className="page-content text-start">
                {/* Section Title Breadcrumbs*/}
                <section className="section-full">
                    <div className="container">
                        <div className="row">
                            <div className="col-12">
                                <h1>Contact Us</h1>
                                <p />
                                <ol className="breadcrumb">
                                    <li>
                                    <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a>
                                    </li>

                                    <li className="active">Contact Us</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                {/*Section Contact Us 2*/}
                <section className="section-lg">
                    <div className="container">
                        <div className="row">
                            <div className="col-lg-8">
                                <h2>Get in Touch</h2>
                                <hr />
                                <p>
                                    You can contact us any way that is convenient for you. We are
                                    available 24/7 via fax or email. You can also use a quick contact
                                    form below or visit our office personally.
                                </p>
                                {/* RD Mailform*/}
                                <form
                                    className="rd-mailform text-start offset-custom-11"
                                   
                                    onSubmit={handleSubmit(onSubmit)}
                                    id="form"
                                    noValidate="novalidate"
                                >
                                    <div className="row">
                                        <div className="col-md-6">
                                            <Controller
                                                control={control}
                                                name="name"
                                                render={({ field }) => (
                                                    <div className={errors?.name ? "form-wrap  has-error" : "form-wrap"}>
                                                        <label
                                                            className="form-label rd-input-label"
                                                            htmlFor="contact-name"
                                                        >
                                                            Your name
                                                        </label>
                                                        <input
                                                            className="form-input form-control-has-validation form-control-last-child"
                                                            id="contact-name"
                                                            type="text"
                                                            name="name"
                                                            data-constraints="@Required"
                                                            {...field}
                                                        />
                                                        {errors?.name ? <span className="form-validation" >{errors?.name?.message}</span> : null}
                                                    </div>
                                                )}
                                            />

                                        </div>
                                        <div className="col-md-6 input-mod-1">
                                            <Controller
                                                control={control}
                                                name="phone"
                                                render={({ field }) => (
                                                    <div className={errors?.phone ? "form-wrap  has-error" : "form-wrap"}>
                                                        <label className="form-label rd-input-label" htmlFor="contact-name">
                                                            Your phone
                                                        </label>
                                                        <PhoneInput country={'us'} inputStyle={{ width: "100%", borderRadius: 0, padding: "11px 48px 13px", height: 50, border: "1px solid #e7e7e7" }} {...field} inputClass='form-input form-control-has-validation form-control-last-child' />

                                                        {errors.phone ? <span className="form-validation">{errors?.phone?.message}</span> : null}
                                                    </div>
                                                )}

                                            />
                                        </div>
                                        <div className="col-md-6">
                                            <Controller
                                                control={control}
                                                name="email"
                                                render={({ field }) => (
                                                    <div className={errors?.email ? "form-wrap  has-error" : "form-wrap"}>
                                                        <label className="form-label rd-input-label" htmlFor="contact-name">
                                                            Your e-mail
                                                        </label>
                                                        <input
                                                            className="form-input form-control-has-validation form-control-last-child"
                                                            id="contact-name"
                                                            type="email"

                                                            data-constraints="@Required"
                                                            required
                                                            {...field}
                                                        />
                                                        {errors.email ? <span className="form-validation">{errors?.email?.message}</span> : null}
                                                    </div>
                                                )}

                                            />
                                        </div>
                                        <div className="col-md-6">
                                            <Controller 
                                            control={control}
                                            name="property_id"
                                            render={({field:{value}})=>(
                                                <div className={errors?.property_id ? "form-wrap  has-error" : "form-wrap"} >
                                                <label
                                                    className="form-label rd-input-label"
                                                    htmlFor="contact-email"
                                                >
                                                    Select the property you require more information about
                                                </label>
                                                <select
                                                    className=" form-input form-control-has-validation form-control-last-child select2"
                                                    // id="contact-email"
                                                    name="seect_propery[]"
                                                    ref={propertyRef}
                                                    multiple="multiple"
                                                    value={value}
                                                >
                                                    {propertyOptions.map((item) => (
                                                        <option key={item.id} value={item.id} >{item.title}</option>
                                                    ))}


                                                </select>
                                                { errors?.property_id? <span className="form-validation" >{errors?.property_id?.message}</span>:null}
                                            </div>
                                            )}
                                            
                                            />
                                            
                                        </div>
                                        <div className="col-12">
                                            <Controller 
                                            control={control}
                                            name="message"
                                            render={({field})=>(
                                                <div className={errors?.message ? "form-wrap  has-error" : "form-wrap"}>
                                                <label
                                                    className="form-label rd-input-label"
                                                    htmlFor="contact-message"
                                                >
                                                    Message
                                                </label>
                                                <textarea
                                                    className="form-input form-control-has-validation form-control-last-child"
                                                    id="contact-message"
                                                    name="message"
                                                    data-constraints="@Required"
                                                    defaultValue={""}
                                                    {...field}
                                                />
                                                { errors?.message? <span className="form-validation" >{errors?.message?.message}</span>:null}
                                            </div>
                                            )}
                                            
                                            />
                                          
                                        </div>
                                    </div>
                                    <button className="btn btn-sushi btn-sm" type="submit">
                                        { formBusy?"Please wait....":  "Send message"}
                                    </button>
                                </form>
                            </div>
                            <div className="col-lg-4 offset-custom-7">
                                <div className="row row-mod-1 flow-offset-6 sidebar text-md-center text-lg-start">
                                    <div className="col-12 col-md-4 col-lg-12">
                                        <dl className="contact-info">
                                            <dt>
                                                <span className="h4 border-bottom">Phone</span>
                                            </dt>
                                            <dd>
                                                <a className="text-light-custom" href="callto:#">
                                                    +1 310-706-2585
                                                    <br />
                                                </a>

                                            </dd>
                                        </dl>
                                    </div>
                                    <div className="col-12 col-md-4 col-lg-12">
                                        <dl className="contact-info">
                                            <dt>
                                                <span className="h4 border-bottom">E-mail</span>
                                            </dt>
                                            <dd>
                                                <a className="text-sushi" href="mailto:#">
                                                    ra@mybajaproperty.com
                                                </a>
                                            </dd>
                                        </dl>
                                    </div>
                                    {/* <div className="col-12 col-md-4 col-lg-12">
                                        <h4 className="border-bottom">Follow Us</h4>
                                        <div className="icon-group">
                                            <a className="icon icon-sm icon-social fa-facebook" href="#" />
                                            <a className="icon icon-sm icon-social fa-twitter" href="#" />
                                            <a
                                                className="icon icon-sm icon-social fa-google-plus"
                                                href="#"
                                            />
                                        </div>
                                    </div> */}
                                    {/* <div className="col-12 col-md-6 col-lg-12">
                                        <address className="address">
                                            <span className="h4 border-bottom">Address</span>
                                            <p>795 Folsom Ave, Suite 600 San Francisco, CA 94107</p>
                                        </address>
                                    </div> */}
                                    {/* <div className="col-12 col-md-6 col-lg-12">
                                        <h4 className="border-bottom">Open Hours</h4>
                                        <p>8:00 - 18:00 Mon - Sat</p>
                                    </div> */}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*Section Google map*/}

            </main>

        </>
    )
}

export default ContactUs