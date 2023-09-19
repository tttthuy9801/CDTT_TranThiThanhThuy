import React, { useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { Link, Navigate } from 'react-router-dom'
import { setCurrent, setRole, setToken } from '../../state/userSlice'


export default function AuthBox() {
    var dispatch=useDispatch()
    var user = useSelector((state) => state.user.current)
    const [userRole,setUserRole] =useState(useSelector((state) => state.user.role))
    const handleLogout = () => {
        dispatch(setCurrent({}));
        dispatch(setToken(''));
        dispatch(setRole('Public'));

        localStorage.clear()
        setUserRole('Public')
    }
    var myView = JSON.stringify(user) == '{}' ?
        <span>
            <Link to='/register'><span className="icon-edit"></span> Register </Link>
            <Link to='/login'><span className="icon-signin"></span> Login </Link>
        </span> : <span>
            <a href="#st"><span className="icon-user"></span>Welcome, {user.username} </a>
            <a href="#st"><span className="icon-user"></span> My Account</a>
            <a onClick={handleLogout}><span className="icon-signout"></span> Logout</a>
        </span>
    return (
        <>
            {(userRole == 'Public') && <Navigate to='/product' replace={true}/>}
            {myView}
        </>
    )
}
