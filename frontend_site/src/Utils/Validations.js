import * as yup from "yup"


export const EvaluationSchema = yup.object().shape({
    fname:yup.string().required("First name is required"),
    lname:yup.string().required("Last name is required"),
    email:yup.string().required("Email is required").email("Enter valid email"),
    phone:yup.string().required("Phone is required"),
    address:yup.string().required("Address is required"),
    city:yup.string().required("City is required"),
    state:yup.string().required("State is required"),
    zip:yup.string().required("zip is required"),
    year_built:yup.string().required("Year Built is required"),
    agree:yup.boolean().required("This field is required"),

})

export const ContactSchema = yup.object().shape({
    name:yup.string().required("Name is required"),
    phone:yup.string().required("Phone is required"),
    email:yup.string().required("Email is required").email("Enter valid email"),
    property_id:yup.array().required("Property is required"),
    message:yup.string().required("Message is required"),
})

export const LoginSchema = yup.object().shape({
    email:yup.string().required("Email is required").email("Enter valid email"),
    password:yup.string().required("Password is required"),
})