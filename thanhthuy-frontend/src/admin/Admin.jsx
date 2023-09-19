import React, { useState } from 'react'
import TopNav from './component/TopNav'
import Menu from './component/Menu'
import { Navigate, Outlet } from 'react-router-dom';
import { useSelector } from 'react-redux';



export default function Admin() {
  const [role, setRole] = useState(useSelector((state) => state.user.role))
  var ss = document.createElement("link");
  ss.rel = "stylesheet";
  ss.type = "text/css";
  ss.href = "/admin/dist/css/adminlte.min.css";
  document.head.appendChild(ss);
  return (
    <div className="wrapper" >
      {(role == 'Authenticated') && (
        <Navigate to="/product" replace={true} />
      )}
      {(role == 'Public') && (
        <Navigate to="/login" replace={true} />
      )}
      <TopNav />
      <Menu />
      <div className="content-wrapper" style={{ minHeight: 815 }}>
        <section className="content-header">
          <div className="container-fluid">
            <div className="row mb-2">
              <div className="col-sm-6">

              </div>
            </div>
          </div>
        </section>
        <section className="content">
          <div className="container-fluid">
            <div className="row">
              <div className="col-12">
                <Outlet />
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

  )
}
