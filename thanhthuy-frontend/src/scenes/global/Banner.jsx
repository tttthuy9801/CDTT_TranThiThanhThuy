import React from 'react'
import { Link } from 'react-router-dom'

export default function Banner() {
  return (
    <header id="header">
      <div className="row">
        <div className="span4">
          <h1>
            <Link className="logo" to='/'><span>Twitter Bootstrap ecommerce template</span>
              <img src="/app/assets/img/logo-bootstrap-shoping-cart.png" alt="bootstrap sexy shop" />
            </Link>
          </h1>
        </div>
        <div className="span4">
          <div className="offerNoteWrapper">
            <h1 className="dotmark">
              <i className="icon-cut" />
              Twitter Bootstrap shopping cart HTML template is available @ $14
            </h1>
          </div>
        </div>
        <div className="span4 alignR">
          <p><br /> <strong> Support (24/7) :  0800 1234 678 </strong><br /><br /></p>
          <Link to='/cart'><span className="btn btn-mini"><span className="icon-shopping-cart" ></span></span></Link>
          <span className="btn btn-warning btn-mini">$</span>
          <span className="btn btn-mini">£</span>
          <span className="btn btn-mini">€</span>
        </div>
      </div>
    </header>

  )
}
