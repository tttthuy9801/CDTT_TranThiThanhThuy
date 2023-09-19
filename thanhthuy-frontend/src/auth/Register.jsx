import React, { useState } from 'react'
import { useForm } from 'react-hook-form'
import { userApi } from '../Api/userApi'
import { useDispatch } from 'react-redux';
import { setCurrent, setToken } from '../state/userSlice';
import { ToastContainer, toast } from 'react-toastify';
import Loading1 from '../component/Loading1';
import InputPassword from '../component/InputPassword';

export default function Register() {
    const { reset, register, handleSubmit, getValues, formState: { errors } } = useForm();
    const [loading, setLoading] = useState(false)
    const dispatch = useDispatch()
    const validateConfirmPassword = (value) => {
        var { password } = getValues()
        return value == password;
    }
    var myView = loading == true ? <Loading1 /> : ''
    const onSubmit = (data) => {
        // goi api register
        const callRegister = async (data) => {
            try {
                setLoading(true)
                const response = await userApi.register(data);
                dispatch(setCurrent(response.data.user));
                dispatch(setToken(response.data.user));
                //lưu trong localStorage
                localStorage.setItem('user', JSON.stringify(response.data.user))
                localStorage.setItem('token', JSON.stringify(response.data.jwt))
                //thanh cong
                toast.success('Đăng ký tài khoản thành công  ')
                setLoading(false)
                reset()
            }
            catch (e) {
                //hien thi loi
                toast.error('Đăng ký tài khoản không thành công! ', e)
            }
        }
        callRegister(data)
    };
    return (
        <div >
            <ul className="breadcrumb">
                <li><a href="index.html">Home</a> <span className="divider">/</span></li>
                <li className="active">Registration</li>
            </ul>
            <h3> Registration</h3>
            <hr className="soft" />
            <div className="well">
                <form className="form-horizontal" onSubmit={handleSubmit(onSubmit)} >
                    <h3>Your Personal Details</h3>
                    <div className="control-group">

                    </div>
                    <div className="control-group">
                        <label className="control-label" htmlFor="inputFname">Username<sup>*</sup></label>
                        <div className="controls">
                            <input {...register('username', { required: true, minLength: 2 })} type="text" id="inputFname" placeholder="inputFname" />
                            {errors.username?.type === 'required' && <p style={{ color: 'red' }}>username is required</p>}
                            {errors.username?.type === 'minLength' && <p style={{ color: 'red' }}>username must have at least 2 character</p>}
                        </div>
                    </div>
                    <div className="control-group">
                        <label className="control-label" htmlFor="inputEmail">Email <sup>*</sup></label>
                        <div className="controls">
                            <input {...register('email', { required: true, pattern: /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/ })} type="text" placeholder="Email" />
                            {errors.email?.type === 'required' && <p style={{ color: 'red' }}>email is required</p>}
                            {errors.email?.type === 'pattern' && <p style={{ color: 'red' }}>wrong email </p>}
                        </div>
                    </div>
                    <div className="control-group">
                        <label className="control-label">Password <sup>*</sup></label>
                        <div className="controls">
                            <InputPassword label='password' register={register} validateFunction={() => { return true }} />
                            {errors.password?.type === 'required' && <p style={{ color: 'red' }}>Password required </p>}
                            {errors.password?.type === 'pattern' && <p style={{ color: 'red' }}>Mật khẩu ít nhất 8 ký tự, 1 chữ hoa, 1 chữ thường, 1 số, 1 ký tự đặc biệt</p>}
                        </div>
                    </div>
                    <div className="control-group">
                        <label className="control-label">Confirm Password <sup>*</sup></label>
                        <div className="controls">
                            <InputPassword label='confirmPassword' register={register} validateFunction={validateConfirmPassword} />
                            {errors.confirmPassword?.type === 'required' && <p style={{ color: 'red' }}>Password required </p>}
                            {errors.confirmPassword?.type === 'pattern' && <p style={{ color: 'red' }}>Mật khẩu ít nhất 8 ký tự, 1 chữ hoa, 1 chữ thường, 1 số, 1 ký tự đặc biệt</p>}
                            {errors.confirmPassword?.type === 'validate' && <p style={{ color: 'red' }}> Password and confirm password not match</p>}
                        </div>
                    </div>
                    <div className="control-group">
                        <div className="controls">
                            {myView}
                            <input type="submit" name="submitAccount" defaultValue="Register" className="exclusive shopBtn" />
                        </div>
                    </div>
                </form>
            </div>
            <ToastContainer />
        </div>

    )
}