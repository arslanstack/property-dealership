import React from 'react'
import { useForm, Controller } from 'react-hook-form'
import { yupResolver } from '@hookform/resolvers/yup'
import { LoginSchema } from '../Utils/Validations'


const Login = () => {

    const { control, handleSubmit, formState: { errors } } = useForm({
        resolver: yupResolver(LoginSchema)
    })

    const onSubmit = (e) => {
        console.log(e)
    }


    return (
        <>
            <section className="section-lg">
                <div className="container">
                    <div className='text-center' >
                        <h2 >Login</h2>
                        <hr />
                    </div>
                    <div className="row offset-custom-8 justify-content-center ">
                        <div className="col-12 col-lg-7 col-xl-5">
                            {/* Login form*/}
                            <form noValidate onSubmit={handleSubmit(onSubmit)} >
                                <Controller
                                    control={control}
                                    name="email"
                                    render={({ field }) => (
                                        <div className={errors?.email ? "form-wrap  has-error" : "form-wrap"}>
                                            <label className="form-label rd-input-label" htmlFor="name">
                                                Email
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
                               <Controller
                                    control={control}
                                    name="password"
                                    render={({ field }) => (
                                        <div className={errors?.password ? "form-wrap  has-error" : "form-wrap"}>
                                            <label className="form-label rd-input-label" htmlFor="name">
                                                Password
                                            </label>
                                            <input
                                                className="form-input form-control-has-validation form-control-last-child"
                                                id="contact-name"
                                                type="password"

                                                data-constraints="@Required"
                                                required
                                                {...field}
                                            />
                                            {errors.password ? <span className="form-validation">{errors?.password?.message}</span> : null}
                                        </div>
                                    )}

                                />
                               
                                <div className="form-wrap-btn w-100 ">
                                    <button
                                        className="btn btn-sushi btn-sm btn-min-width-xs w-100 "
                                        type="submit"
                                    >
                                        Enter
                                    </button>
                                    {/* <p>or enter with</p>
                                    <div className="icon-group">
                                        <a className="icon icon-sm icon-social fa-facebook" href="#" />
                                        <a className="icon icon-sm icon-social fa-twitter" href="#" />
                                        <a className="icon icon-sm icon-social fa-google-plus" href="#" />
                                    </div> */}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </>
    )
}

export default Login