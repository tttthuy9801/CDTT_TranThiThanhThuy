import React, { useEffect, useState } from 'react'
import PictureBox from './PictureBox'
import { useParams } from 'react-router-dom'
import Loading from '../../component/Loading';
import { productApi } from '../../Api/productApi';
import currency from 'currency.js';
import { useDispatch } from "react-redux";
import { addToCart } from '../../state/cartSlice';

export default function ProductDetail() {
  const dispatch = useDispatch()
  var { id } = useParams();
  const [product, setProduct] = useState({});
  const [loading, setLoading] = useState(true);
  var params = {
    populate: '*'
  }
  useEffect(() => {
    const fetchData = async () => {
      const response = await productApi.get(id, params)
      console.log(response)
      setProduct(response.data.data)
      setLoading(false)
    }
    fetchData()
  }, [])
  var myView1 = loading === true ? <Loading /> : <PictureBox images={product.attributes.image.data} />
  var myView2 = loading === true ? <Loading /> :
    <div>
      <h3>{product.attributes.productName} [{
        currency(product.attributes.price, { symbol: 'đ', separator: '.', decimal: ',' }).format()
      }]
      </h3>
      <hr className="soft" />
      <form className="form-horizontal qtyFrm">
        <div className="control-group">
          <label className="control-label"><span>{
            currency(product.attributes.price, { symbol: 'đ', separator: '.', decimal: ',' }).format()
          }</span></label>
          <div className="controls">
            <input type="number" className="span6" placeholder="Qty." />
          </div>
        </div>
        <p>
          <button type="submit" className="shopBtn" onClick={()=>dispatch(addToCart({item:{...product, count:1}}))}><span className=" icon-shopping-cart" /> Add to cart</button>
        </p></form>
    </div>
  var myView3 = loading === true ? <Loading /> : <div>{product.attributes.description}</div>

  return (
    <div className="well well-small">
      <div className="row-fluid">
        <div className="span5">
          {myView1}
        </div>
        <div className="span7">
          {myView2}
        </div>
      </div>
      <hr className="softn clr" />
      <ul id="productDetail" className="nav nav-tabs">
        <li className="active"><a href="#home" data-toggle="tab">Product Details</a></li>
      </ul>
      <div id="myTabContent" className="tab-content tabWrapper">
        <div className="tab-pane fade active in" id="home">
          <h4>Product Information</h4>
          {myView3}
        </div>
      </div>
    </div>

  )
}
