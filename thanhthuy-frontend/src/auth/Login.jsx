import React, { useState } from 'react'
import { useForm } from 'react-hook-form'
import { userApi } from '../Api/userApi'
import { useDispatch } from 'react-redux';
import { setCurrent, setRole, setToken } from '../state/userSlice';
import { ToastContainer, toast } from 'react-toastify';
import InputPassword from '../component/InputPassword';
import Loading1 from '../component/Loading1';
import { Navigate } from 'react-router-dom';

export default function Login() {
    const { reset, register, handleSubmit, getValues, formState: { errors } } = useForm();
    const [loading, setLoading] = useState(false)
    const [userRole, setUserRole] = useState('Public')
    const dispatch = useDispatch()
    var myView = loading == true ? <Loading1 /> : ''
    const onSubmit = (data) => {
        // goi api register
        const callLogin = async (data) => {
            try {
                setLoading(true)
                const response = await userApi.login(data);
                dispatch(setCurrent(response.data.user));
                dispatch(setToken(response.data.jwt));
                //lưu trong localStorage
                localStorage.setItem('user', JSON.stringify(response.data.user))
                localStorage.setItem('token', response.data.jwt)
                //thanh cong
                toast.success('Đăng nhập tài khoản thành công ')
                setLoading(false)
                reset()
                //
                const getInfo = async () => {
                    var response1 = await userApi.me({ populate: '*' });
                    localStorage.setItem('role', response1.data.role.name);
                    dispatch(setRole(response1.data.role.name));
                    setUserRole(response1.data.role.name);
                }
                getInfo()
            }
            catch (e) {
                //hien thi loi
                toast.error('Đăng nhập tài khoản không thành công!  ')
            }
        }
        callLogin(data)

    };

    return (
        <div >
            {(userRole == 'admin') && (
                <Navigate to="/admin/product" replace={true} />
            )}
            {(userRole == 'Authenticated') && (
                <Navigate to="/product" replace={true} />
            )}
            <ul className="breadcrumb">
                <li><a href="index.html">Home</a> <span className="divider">/</span></li>
                <li className="active">Login</li>
            </ul>
            <h3> Login</h3>
            <hr className="soft" />
            <div className="row">
                <div className="span4"> &nbsp;</div>
                <div className="span4">
                    <div className="well">
                        <h5>ALREADY REGISTERED ?</h5>
                        <form onSubmit={handleSubmit(onSubmit)}>
                            <div className="control-group">
                                <label className="control-label" htmlFor="inputEmail">Username</label>
                                <div className="controls">
                                    <input {...register('identifier', { required: true, minLength: 2 })} type="text" id="inputFname" placeholder="inputFname" />
                                    {errors.identifier?.type === 'required' && <p style={{ color: 'red' }}>username is required</p>}
                                    {errors.identifier?.type === 'minLength' && <p style={{ color: 'red' }}>username must have at least 2 character</p>}

                                </div>
                            </div>
                            <div className="control-group">
                                <label className="control-label" htmlFor="inputPassword">Password</label>
                                <div className="controls">
                                    <InputPassword label='password' register={register} validateFunction={() => { return true }} />
                                    {errors.password?.type === 'required' && <p style={{ color: 'red' }}>Password required </p>}
                                    {errors.password?.type === 'pattern' && <p style={{ color: 'red' }}>Mật khẩu ít nhất 8 ký tự, 1 chữ hoa, 1 chữ thường, 1 số, 1 ký tự đặc biệt</p>}
                                </div>
                            </div>
                            <div className="control-group">
                                <div className="controls">
                                    {myView}
                                    <button type="submit" className="defaultBtn">Sign in</button> <a href="#st">Forget password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <ToastContainer />
        </div>

    )
}