import axios from "axios"


export const GetRequest = async(url)=>{
    try{
      const res = await axios.get(url)
      return res.data
        

    }catch(error){
        throw error
    }
}

export const PostRequest = async(url,data)=>{
    try{
        const res = await axios.post(url,data)
        return res.data
    }catch(error){
        throw error
    }
}