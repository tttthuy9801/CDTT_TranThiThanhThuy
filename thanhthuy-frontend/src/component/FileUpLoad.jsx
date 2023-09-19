import axios from 'axios'
import React from 'react'
import { useState } from 'react'

export default function FileUpLoad(props) {
    var [file, setFile] = useState([])
    var addImage=props.addImage
    const handleChange = (e) => {
        setFile(e.target.files[0])
        console.log('Chọn file',e.target.files)
    }
    const handleUpLoad = async (e) => {
        console.log('send file', file)
        const data = new FormData();
        data.append('files', file)
        e.target.innerText='Uploading........'
        const response = await axios({
            method: 'POST',
            url: 'http://localhost:1337/api/upload',
            data
        })
        e.target.innerText='Upload'
        var id = response.data[0].id
        var url=response.data[0].url
        addImage(id,url)
        console.log('id',id)
    }
  return (
      <div className='fileUpLoad'>
          <input type='file' onChange={handleChange}/>
          <button onClick={handleUpLoad} >send</button>
    </div>
  )
}
