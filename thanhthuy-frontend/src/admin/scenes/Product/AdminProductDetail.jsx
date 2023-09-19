import React, { useEffect, useState } from 'react'
import { productApi } from '../../../Api/productApi';
import 'react-toastify/dist/ReactToastify.css'
import AppUrl from '../../../Api/AppUrl';
import { useParams } from 'react-router-dom';

export default function AdminProductDetail(props) {
  var handleDelete=props.handleDelete
  const { id } = useParams();
  const [data, setData] = useState({
    "productName": "",
    "description": "",
    "category": "",
    "price": "",
    "detail": "",
    "image": [],
  });
  const [images, setImages] = useState([])
  useEffect(() => { 
    const fetchData = async(id) => {
      var params = {
        populate:"*"
      }
      var response = await productApi.get(id, params);
      var oldProduct = response.data.data
      setData({
        "productName": oldProduct.attributes.productName,
        "description": oldProduct.attributes.description,
        "category": oldProduct.attributes.category.data.id,
        "detail": oldProduct.attributes.detail,
        "price": oldProduct.attributes.price,
        'image': oldProduct.attributes.image.data.map((img) => (img.id))
      })
      var oldImages = oldProduct.attributes.image.data.map((img) => {
        return  ({
          id: img.id,
          url:img.attributes.url
        })
      })
      setImages([...oldImages])
    }
    fetchData(id)
  },[id])
  
  
  var myViewImage = images.length == 0 ? 'No image' : 
    images.map((img) => {
      return (
        <div>
          <img src={AppUrl.ImageUrl + img.url} alt='hinh' name={img.id} style={{ margin: '5px', width: '150px', }} />
        </div>
      )
    })
  
  
  return (
    <>
    <div className='row'>
        <div className='col-9'><h2>Show Product</h2></div>
       
        <br /><br /><br />
    </div>
    <div className='row'>
      <div className='col-8'>
        <div className="form-group row">
          <label htmlFor="productName" className="col-2 col-form-label">Product Name</label>
          <div className="col-9">
              <p className="col-9 col-form-label">{data.productName}</p>
          </div>
        </div>
        <div className="form-group row">
          <label htmlFor="description" className="col-2 col-form-label">Description</label>
          <div className="col-9">
              <p className="col-9 col-form-label">{data.description}</p>
          </div>
        </div>
        <div className="form-group row">
          <label htmlFor="detail" className="col-2 col-form-label">Detail</label>
          <div className="col-9">
              <p className="col-9 col-form-label">{data.detail}</p>
          </div>
        </div>
        <div className="form-group row">
          <label htmlFor="price" className="col-2 col-form-label" >Price</label>
          <div className="col-9">
              <p className="col-9 col-form-label">{data.price}</p>
          </div>
        </div>
        <div className="form-group row">
          <label htmlFor="select" className="col-2 col-form-label">Category</label>
          <div className="col-9">
              <p className="col-9 col-form-label">{data.category}</p>
          </div>
        </div>
        
      </div>
      <div className='col-4'>
        <div id='uploadsImgs'>{myViewImage}</div>
      </div>


      
      </div>
      </>
  )
}
