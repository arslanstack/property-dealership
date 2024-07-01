import React, { useState, useEffect } from 'react'
import { Slider } from 'rsuite'
import { GET_EVALUTION_INPUTS_URL,SUBMIT_EVALUTION_URL } from '../Utils/URLs'
import { GetRequest,PostRequest } from '../Services/Api'
import PreLoading from '../Components/PreLoading/PreLoading'
import { useForm, Controller } from 'react-hook-form'
import { yupResolver } from '@hookform/resolvers/yup'
import { EvaluationSchema } from '../Utils/Validations'
import PhoneInput from 'react-phone-input-2'
import 'react-phone-input-2/lib/style.css'
import toast, { Toaster } from 'react-hot-toast';
import { useNavigate } from 'react-router-dom'
const HomeEvalution = () => {
    const [size, setSize] = useState(1600)
    const [bedrooms, setBedrooms] = useState(2)
    const [bathrooms, setBathrooms] = useState(2)
    const [halfBathrooms, setHalfBathrooms] = useState(2)
    const [inputOptions, setInputOptions] = useState({})
    const [loading, setLoading] = useState(true)
    const [hasSuit,setHasSuit] = useState(0)
    const [garage,setGarage] = useState(0)
    const [garageType,setGarageType] = useState(1)
    const [development,setDevelopment] = useState(0)
    const [movePlanning,setMovePlanning] = useState(1)
    const [basementType,setBasementType] = useState(0)
    const [notes,setNotes] = useState("")
    const [formBusy,setFormBusy] = useState(false)
    const navigate = useNavigate()

    const { handleSubmit, formState: { errors }, control,reset } = useForm({
        resolver: yupResolver(EvaluationSchema)
    })


    useEffect(() => {
        const GetData = async () => {
            try {
                const inputoptions = await GetRequest(GET_EVALUTION_INPUTS_URL)
                setInputOptions(inputoptions)
                setLoading(false)
            } catch (error) {
                console.log(error)
            }
        }
        GetData()
    }, [])

    const onSubmit =  async(e) => {
        try{
            const defaultValues = {
                fname: '',
                lname: '',
                email: '',
                phone: '',
                address: '',
                city: '',
                state: '',
                zip: '',
                year_built: '',
               agree:""
              };
            setFormBusy(true)
       
        const data={
            ...e,
            size:size,
            bedroom:bedrooms,
            bathroom:bathrooms,
            half_bathroom:halfBathrooms,
            has_suite:hasSuit,
            garage:garage,
            garage_type:garageType,
            dev_lvl:development,
            move_plan:movePlanning,
            basement_type:basementType,
            notes:notes


        }

        const res =  await PostRequest(SUBMIT_EVALUTION_URL,data)
        toast.success(res.message,{
            position:"top-right",
            duration:4000
        })
        setFormBusy(false)
        reset(defaultValues)
        setNotes("")
        setHasSuit(1)
        setGarage(1)
        setGarageType(1)
        setDevelopment(1)
        setBasementType(1)
        setMovePlanning(1)
        const evaluationForm = document.getElementById("form")
        if (evaluationForm) {
            evaluationForm.scrollIntoView({ behavior: "instant" })
        }
    }catch(error){
        console.log(error)
    }
    }



    return (
        <>
        <Toaster />
            {loading && (
                <PreLoading />
            )}
            <section className="section-full">
                <div className="container">
                    <div className="row">
                        <div className="col-12">
                            <h1>SELLER SERVICES FOR PLAYAS DE ROSARITO HOME SELLERS</h1>
                            <p />
                            <ol className="breadcrumb">
                                <li>
                                <a style={{cursor:"pointer"}} onClick={()=>navigate("/")}>Home</a>
                                </li>

                                <li className="active">Home Evaluation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section className='mt-5' >
                <div className='row justify-content-center ' >
                    <div className='col-12 col-md-8' >
                        <h2>
                            Ready to sell?
                        </h2>
                        <hr />
                        <p>
                            Wondering what your home is worth? I would be happy to help you in whatever way I can. The articles and resources on this page are complimentary and part of the many services I offer.
                        </p>
                        <p>
                            If you would like to request an online home evaluation, please fill out the form below. All information you provide is secure and will be kept strictly confidential. To provide a more detailed Comparative Market Analysis, I would be more than happy to also assess your listing in person.
                        </p>
                        <h2 className='mt-4' >
                            Resources?
                        </h2>
                        <hr />
                        <ul className='mt-4 resoures' >
                            <li>
                                <h4>
                                    <a
                                        href="/assets/Files/TheRightSellingPrice.pdf"
                                        target="_blank"
                                        rel="noopener"
                                    >
                                        THE RIGHT SELLING PRICE
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a
                                        href="/assets/Files/Surviving.pdf"
                                        target="_blank"
                                        rel="noopener"
                                    >
                                        SURVIVING THE SALE
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a
                                        href="/assets/Files/RelocationChecklist.pdf"
                                        target="_blank"
                                        rel="noopener"
                                    >
                                        RELOCATION CHECKLIST
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a
                                        href="/assets/Files/PreparingYourHomeForSale.pdf"
                                        target="_blank"
                                        rel="noopener"
                                    >
                                        PREPARING YOUR HOME FOR SALE
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a
                                        href="/assets/Files/Selling.pdf"
                                        target="_blank"
                                        rel="noopener"
                                    >
                                        SELLING YOUR HOME
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a
                                        href="/assets/Files/SellingMistakes.pdf"
                                        target="_blank"
                                        rel="noopener"
                                    >
                                        COMMON SELLING MISTAKES
                                    </a>
                                </h4>
                            </li>
                        </ul>
                        <h2 className='mt-4' >
                            Please feel free to contact me if have any questions.
                        </h2>
                        <hr />
                        <form
                            className="rd-mailform text-start mt-4"
                            id="form"
                            onSubmit={handleSubmit(onSubmit)}
                            noValidate="novalidate"
                        >
                            <div className="row">
                                <div className="col-md-6">
                                    <Controller
                                        control={control}
                                        name="fname"
                                        render={({ field }) => (
                                            <div className={errors?.fname ? "form-wrap  has-error" : "form-wrap"}>
                                                <label className="form-label rd-input-label" htmlFor="contact-name">
                                                    First name
                                                </label>
                                                <input
                                                    className="form-input form-control-has-validation form-control-last-child"
                                                    id="contact-name"
                                                    type="text"
                                                    
                                                    data-constraints="@Required"
                                                    required
                                                    {...field}
                                                />
                                                {errors.fname ? <span className="form-validation">{errors?.fname?.message}</span> : null}
                                            </div>
                                        )}

                                    />

                                </div>
                                <div className="col-md-6">
                                    <Controller
                                        control={control}
                                        name="lname"
                                        render={({ field }) => (
                                            <div className={errors?.lname ? "form-wrap  has-error" : "form-wrap"}>
                                                <label className="form-label rd-input-label" htmlFor="contact-name">
                                                    Last name
                                                </label>
                                                <input
                                                    className="form-input form-control-has-validation form-control-last-child"
                                                    id="contact-name"
                                                    type="text"
                                                   
                                                    data-constraints="@Required"
                                                    required
                                                    {...field}
                                                />
                                                {errors.lname ? <span className="form-validation">{errors?.lname?.message}</span> : null}
                                            </div>
                                        )}

                                    />
                                </div>
                                <div className="col-md-6 input-mod-1">
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
                                <div className="col-md-6 input-mod-1">
                                <Controller
                                        control={control}
                                        name="phone"
                                        render={({ field }) => (
                                            <div className={errors?.phone ? "form-wrap  has-error" : "form-wrap"}>
                                                <label className="form-label rd-input-label" htmlFor="contact-name">
                                                Your phone
                                                </label>
                                                <PhoneInput country={'us'} inputStyle={{width:"100%",borderRadius:0,padding:"11px 48px 13px",height:50,border:"1px solid #e7e7e7"}} {...field} inputClass='form-input form-control-has-validation form-control-last-child' />
                                               
                                                {errors.phone ? <span className="form-validation">{errors?.phone?.message}</span> : null}
                                            </div>
                                        )}

                                    />
                                </div>
                                <div className="col-md-6 input-mod-1">
                                <Controller
                                        control={control}
                                        name="address"
                                        render={({ field }) => (
                                            <div className={errors?.address ? "form-wrap  has-error" : "form-wrap"}>
                                                <label className="form-label rd-input-label" htmlFor="contact-name">
                                                Address
                                                </label>
                                                <input
                                                    className="form-input form-control-has-validation form-control-last-child"
                                                    id="contact-name"
                                                    type="text"
                                                   
                                                    data-constraints="@Required"
                                                    required
                                                    {...field}
                                                />
                                                {errors.address ? <span className="form-validation">{errors?.address?.message}</span> : null}
                                            </div>
                                        )}

                                    />
                                </div>
                                <div className="col-md-6 input-mod-1">
                                <Controller
                                        control={control}
                                        name="city"
                                        render={({ field }) => (
                                            <div className={errors?.city ? "form-wrap  has-error" : "form-wrap"}>
                                                <label className="form-label rd-input-label" htmlFor="contact-name">
                                                City
                                                </label>
                                                <input
                                                    className="form-input form-control-has-validation form-control-last-child"
                                                    id="contact-name"
                                                    type="text"
                                                   
                                                    data-constraints="@Required"
                                                    required
                                                    {...field}
                                                />
                                                {errors.city ? <span className="form-validation">{errors?.city?.message}</span> : null}
                                            </div>
                                        )}

                                    />
                                </div>
                                <div className="col-md-6 input-mod-1">
                                <Controller
                                        control={control}
                                        name="state"
                                        render={({ field }) => (
                                            <div className={errors?.state ? "form-wrap  has-error" : "form-wrap"}>
                                                <label className="form-label rd-input-label" htmlFor="contact-name">
                                                State
                                                </label>
                                                <input
                                                    className="form-input form-control-has-validation form-control-last-child"
                                                    id="contact-name"
                                                    type="text"
                                                   
                                                    data-constraints="@Required"
                                                    required
                                                    {...field}
                                                />
                                                {errors.state ? <span className="form-validation">{errors?.state?.message}</span> : null}
                                            </div>
                                        )}

                                    />
                                </div>
                                <div className="col-md-6 input-mod-1">
                                <Controller
                                        control={control}
                                        name="zip"
                                        render={({ field }) => (
                                            <div className={errors?.zip ? "form-wrap  has-error" : "form-wrap"}>
                                                <label className="form-label rd-input-label" htmlFor="contact-name">
                                                Zip Code
                                                </label>
                                                <input
                                                    className="form-input form-control-has-validation form-control-last-child"
                                                    id="contact-name"
                                                    type="text"
                                                   
                                                    data-constraints="@Required"
                                                    required
                                                    {...field}
                                                />
                                                {errors.zip ? <span className="form-validation">{errors?.zip?.message}</span> : null}
                                            </div>
                                        )}

                                    />
                                </div>
                                <div className="col-md-12 input-mod-1">
                                <Controller
                                        control={control}
                                        name="year_built"
                                        render={({ field }) => (
                                            <div className={errors?.year_built ? "form-wrap  has-error" : "form-wrap"}>
                                                <label className="form-label rd-input-label" htmlFor="contact-name">
                                                Year Built
                                                </label>
                                                <input
                                                    className="form-input form-control-has-validation form-control-last-child"
                                                    id="contact-name"
                                                    type="text"
                                                   
                                                    data-constraints="@Required"
                                                    required
                                                    {...field}
                                                />
                                                {errors.year_built ? <span className="form-validation">{errors?.year_built?.message}</span> : null}
                                            </div>
                                        )}

                                    />
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                            Size
                                        </label>
                                        <Slider value={size} onChange={(e) => { setSize(e) }} max={10000} min={500} />
                                        <label className=' form-label mt-2 rd-input-label' > Selected value: {size} Sq.Ft. </label>
                                    </div>
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                            Bedroomes
                                        </label>
                                        <Slider value={bedrooms} onChange={(e) => { setBedrooms(e) }} max={10} min={1} />
                                        <label className=' form-label mt-2 rd-input-label' > Selected value: {bedrooms}. </label>
                                    </div>
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                            Bathrooms
                                        </label>
                                        <Slider value={bathrooms} onChange={(e) => { setBathrooms(e) }} max={10} min={1} />
                                        <label className=' form-label mt-2 rd-input-label' > Selected value: {bathrooms}. </label>
                                    </div>
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                            Half Bathrooms
                                        </label>
                                        <Slider value={halfBathrooms} onChange={(e) => { setHalfBathrooms(e) }} max={10} min={1} />
                                        <label className=' form-label mt-2 rd-input-label' > Selected value: {halfBathrooms}. </label>
                                    </div>
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                            Has Suit
                                        </label>
                                        <select value={hasSuit} onChange={(e)=>setHasSuit(e.target.value)} className="form-input select-filter" id="select-search-2" data-minimum-results-for-search="Infinity">
                                            {inputOptions?.data?.has_suite.map((item) => (
                                                <option key={item.id} value={item.id}>{item.name}</option>
                                            ))}


                                        </select>
                                        <span className="form-validation" />
                                    </div>
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                            Garage
                                        </label>
                                        <select value={garage} onChange={(e)=>setGarage(e.target.value)} className="form-input select-filter" id="select-search-2" data-minimum-results-for-search="Infinity">
                                            {inputOptions?.data?.garage.map((item) => (
                                                <option key={item.id} value={item.id}>{item.name}</option>
                                            ))}

                                        </select>
                                        <span className="form-validation" />
                                    </div>
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                            Garage Type
                                        </label>
                                        <select value={garageType} onChange={(e)=>setGarageType(e.target.value)} className="form-input select-filter" id="select-search-2" data-minimum-results-for-search="Infinity">
                                            {inputOptions?.data?.garage_type.map((item) => (
                                                <option key={item.id} value={item.id}>{item.name}</option>
                                            ))}


                                        </select>
                                        <span className="form-validation" />
                                    </div>
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                            Development
                                        </label>
                                        <select value={development} onChange={(e)=>setDevelopment(e.target.value)} className="form-input select-filter" id="select-search-2" data-minimum-results-for-search="Infinity">
                                            {inputOptions?.data?.dev_lvl.map((item) => (
                                                <option key={item.id} value={item.id}>{item.name}</option>
                                            ))}


                                        </select>
                                        <span className="form-validation" />
                                    </div>
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                        Basement Type
                                        </label>
                                        <select value={basementType} onChange={(e)=>setBasementType(e.target.value)} className="form-input select-filter" id="select-search-2" data-minimum-results-for-search="Infinity">
                                            {inputOptions?.data?.basement_type.map((item) => (
                                                <option key={item.id} value={item.id}>{item.name}</option>
                                            ))}


                                        </select>
                                        <span className="form-validation" />
                                    </div>
                                </div>
                                <div className="col-md-6 input-mod-1">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-phone">
                                            When are you planning to move?
                                        </label>
                                        <select value={movePlanning} onChange={(e)=>setMovePlanning(e.target.value)} className="form-input select-filter" id="select-search-2" data-minimum-results-for-search="Infinity">
                                            {inputOptions?.data?.move_plan.map((item) => (
                                                <option key={item.id} value={item.id}>{item.name}</option>
                                            ))}


                                        </select>
                                        <span className="form-validation" />
                                    </div>
                                </div>
                                <div className="col-12">
                                    <div className="form-wrap">
                                        <label className="form-label rd-input-label" htmlFor="contact-message">
                                            Notes
                                        </label>
                                        <textarea
                                            className="form-input form-control-has-validation form-control-last-child"
                                            id="contact-message"
                                            name="message"
                                            data-constraints="@Required"
                                            defaultValue={""}
                                            value={notes}
                                            onChange={(e)=>setNotes(e.target.value)}
                                        />
                                        <span className="form-validation" />
                                        <label className="form-label rd-input-label" >
                                            Please describe any special features and recent upgrades. (e.g. age of carpet & lino, type of kitchen cabinets, property backs park, major renovations in recent years)
                                        </label>
                                    </div>
                                </div>
                                <div className="col-12">
                                    <Controller 
                                    control={control}
                                    name="agree"
                                    render={({field})=>(
                                        <div className="form-wrap has-error ">
                                        <div>
                                            <label className="form-label rd-input-label" htmlFor="contact-message">
                                                I agree to :
                                            </label>
                                        </div>
                                        <input
                                            className=" form-control-has-validation form-control-last-child"
                                            id="agree"
                                            name="agree"
                                            data-constraints="@Required"
                                            defaultValue={""}
                                            type="checkbox"
                                            {...field}
                                        />
                                        <label className="form-label rd-input-label mx-2" htmlFor="agree">
                                            Receive additional information via email. Unsubscribe at any time.
                                        </label>
                                        <div>
                                        {errors?.agree? <span style={{color:"#d95139",fontSize:"11px"}} >{errors?.agree?.message}</span>:null}
                                        </div>
                                    </div>
                                    )}
                                    
                                    
                                    />
                                   
                                </div>
                            </div>

                            <button className="btn btn-sushi btn-sm mb-5" type="submit">
                                {formBusy?"Please wait....":"Submit"}
                            </button>
                        </form>

                    </div>


                </div>

            </section>
        </>
    )
}

export default HomeEvalution