import React, { useEffect, useState } from 'react'
import Header from '../../Header';
import Menu from '../../Menu';
import axios from 'axios'
import { api_url } from '../ApiUrl';
import { DataGrid } from '@mui/x-data-grid';
import { Modal, Button } from "react-bootstrap";

function CompanyContact() {
    const [showModal, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const [showModal1, setShow1] = useState(false);
    const handleClose1 = () => setShow1(false);
    const handleShow1 = () => setShow1(true);


    const [formValues, setFormValues] = useState([{ contact_person: "", designation: "" }])
    let handleChange = (i, e) => {
        let newFormValues = [...formValues];
        newFormValues[i][e.target.name] = e.target.value;
        setFormValues(newFormValues);
        //console.log(formValues);
        setContact({ ...contact, contact_person_designation: formValues })
    }

    let addFormFields = () => {
        setFormValues([...formValues, { contact_person: "", designation: "" }])
    }

    let removeFormFields = (i) => {
        let newFormValues = [...formValues];
        newFormValues.splice(i, 1);
        setFormValues(newFormValues)
    }
    const [formValues1, setFormValues1] = useState(null)


    let addFormFields1 = () => {
        setFormValues1([...formValues1, { contact_person: "", designation: "" }])
    }

    let removeFormFields1 = (j) => {
        let newFormValues1 = [...formValues1];
        newFormValues1.splice(j, 1);
        setFormValues1(newFormValues1)
        console.log(formValues1);
        setModalContact({ ...modalContact, contact_person_designation: newFormValues1 })
    }
    let handleChange1 = (j, e) => {
        let newFormValues = [...formValues1];
        newFormValues[j][e.target.name] = e.target.value;
        setFormValues1(newFormValues);
        console.log(formValues1);
        setModalContact({ ...modalContact, contact_person_designation: formValues1 })
    }
    //Read Form
    const [formValues2, setFormValues2] = useState(null)



    let handleChange2 = (j, e) => {
        let newFormValues = [...formValues2];
        newFormValues[j][e.target.name] = e.target.value;
        setFormValues1(newFormValues);
        console.log(formValues2);
        setSingleReadContact({ ...singleReadContact, contact_person_designation: formValues2 })
    }
    //States
    const [contact, setContact] = useState({
        name: "",
        address1: "",
        address2: "",
        address3: "",
        mobile_number: "",
        email_id: "",
        website: "",
        director_name: "",
        director_mobile: "",
        director_email_id: "",
        type_of_industry: "",
        gst: "",
        pan: "",
        tan: "",
        contact_person_designation: [],
        username: "",
        password: ""
    });
    const [readContact, setReadContact] = useState({
        name: "",
        address1: "",
        address2: "",
        address3: "",
        mobile_number: "",
        email_id: "",
        website: "",
        director_name: "",
        director_mobile: "",
        director_email_id: "",
        type_of_industry: "",
        gst: "",
        pan: "",
        tan: "",
        contact_person_designation: [],
        username: "",
        password: ""
    });
    const [modalContact, setModalContact] = useState({
        id: "",
        name: "",
        address1: "",
        address2: "",
        address3: "",
        mobile_number: "",
        email_id: "",
        website: "",
        director_name: "",
        director_mobile: "",
        director_email_id: "",
        type_of_industry: "",
        gst: "",
        pan: "",
        tan: "",
        contact_person_designation: [],
        username: "",
        password: ""
    });
    const [singleReadContact, setSingleReadContact] = useState({
        id: "",
        name: "",
        address1: "",
        address2: "",
        address3: "",
        mobile_number: "",
        email_id: "",
        website: "",
        director_name: "",
        director_mobile: "",
        director_email_id: "",
        type_of_industry: "",
        gst: "",
        pan: "",
        tan: "",
        contact_person_designation: [],
        username: "",
        password: ""
    });
    //Get Query
    useEffect(() => {
        axios.get(api_url+"read_company_customer.php", {
            headers: {
                'Content-Type': 'application/json',
            }
        }
        )
            .then((res) => {
                setReadContact(res.data)
            })
    }, [])
    //Event Handlers
    const onInputChange = (e) => {
        setContact({ ...contact, [e.target.name]: e.target.value });
    }
    const onModalInputChange = (e) => {
        setModalContact({ ...modalContact, [e.target.name]: e.target.value });
    }
    const onFormSubmit = (e) => {
        //setContact({ ...contact, contact_person_designation: formValues })
        e.preventDefault();
        console.log(contact);
        axios.post(api_url+"register_company_customer.php", contact)
            .then((res) => {
                axios.get(api_url+"read_company_customer.php", {
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }
                )
                    .then((res) => {
                        setReadContact(res.data)
                    })
            })

        handleClose();
        document.getElementById("contactsubmit").reset();
        // setformValues("");  
        // FormValues(contact_person,designation);
        setFormValues([]);


        // document.getElementById("contactperson").reset();         
    }
    const onRead = (row) => {
        console.log(row);
        handleShow1();
        setSingleReadContact({
            id: row.id,
            name: row.name,
            address1: row.address1,
            address2: row.address2,
            address3: row.address3,
            mobile_number: row.mobile_number,
            email_id: row.email_id,
            website: row.website,
            director_name: row.director_name,
            director_mobile: row.director_mobile,
            director_email_id: row.director_email_id,
            type_of_industry: row.type_of_industry,
            gst: row.gst,
            pan: row.pan,
            tan: row.tan,
            contact_person_designation: JSON.parse(row.contact_person_designation),
            username: row.username,
            password: row.password
        })
        //console.log("------", JSON.parse(row.contact_person_designation))
        //var dat=JSON.parse(modalContact.contact_person_designation)
        setFormValues2(JSON.parse(row.contact_person_designation))

        //console.log("----",formValues1)
    }

    let onEdit = (row) => {
        handleShow();
        setModalContact({
            id: row.id,
            name: row.name,
            address1: row.address1,
            address2: row.address2,
            address3: row.address3,
            mobile_number: row.mobile_number,
            email_id: row.email_id,
            website: row.website,
            director_name: row.director_name,
            director_mobile: row.director_mobile,
            director_email_id: row.director_email_id,
            type_of_industry: row.type_of_industry,
            gst: row.gst,
            pan: row.pan,
            tan: row.tan,
            contact_person_designation: JSON.parse(row.contact_person_designation),
            username: row.username,
            password: row.password
        })
        //console.log("------", JSON.parse(row.contact_person_designation))
        //var dat=JSON.parse(modalContact.contact_person_designation)
        setFormValues1(JSON.parse(row.contact_person_designation))

        //console.log("----",formValues1)
    }

    const onModalFormSubmit = (e) => {
        e.preventDefault();
        console.log(modalContact);
        axios.post(api_url+"update_company_customer.php", modalContact)
            .then((res) => {
                axios.get(api_url+"read_company_customer.php", {
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }
                )
                    .then((res) => {
                        setReadContact(res.data)
                    })
            })
        handleClose();
    }


    const onDelete = (rowid) => {
        axios.post(api_url+"delete_company_customer.php", { id: rowid })
            .then(() => {
                axios.get(api_url+"read_company_customer.php", {
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                    .then((res) => {
                        setReadContact(res.data)
                    })
            })
    }

    //Table columns
    const columns = [
        {
            field: "id",
            headerName: "ID",
        },
        {
            field: "name",
            headerName: "Name",
        },
        {
            field: "address1",
            headerName: "Address1",
        },
        {
            field: "address2",
            headerName: "Address2",
        },
        {
            field: "address3",
            headerName: "Address3",
        },
        {
            field: "mobile_number",
            headerName: "Mobile No",
        },
        {
            field: "contact_person_designation",
            headerName: "Contact",
            width: 200
        },
        // {
        //     field: "website",
        //     headerName: "Website",
        // },
        // {
        //     field: "director_name",
        //     headerName: "Director Name",
        // },
        // {
        //     field: "director_mobile",
        //     headerName: "Director Mobile",
        // },
        // {
        //     field: "director_email_id",
        //     headerName: "Director Email Id",
        // },
        // {
        //     field: "type_of_industry",
        //     headerName: "Type Of Industry",
        // },
        // {
        //     field: "gst",
        //     headerName: "GST",
        // },
        // {
        //     field: "pan",
        //     headerName: "PAN",
        // },
        // {
        //     field: "tan",
        //     headerName: "TAN",
        // },
        // {
        //     field: "username",
        //     headerName: "Username",
        // },
        // {
        //     field: "password",
        //     headerName: "Password",
        // },
        // {
        //     field: "approval",
        //     headerName: "Approval",
        // },
        {
            field: 'action',
            headerName: 'Action',
            width: 200,
            renderCell: (params) => {
                return (
                    <div className="">
                        <button onClick={() => onRead(params.row)} data-toggle="tooltip" title="Read" type="button" className="btn btn-primary"  ><i class="far fa-eye"></i></button>
                        <button onClick={() => onEdit(params.row)} data-toggle="tooltip" title="Edit" style={{ marginLeft: '20%' }} type="button" className="btn btn-warning"  ><i class="far fa-edit"></i></button>
                        <button onClick={() => {
                            const confirmBox = window.confirm(
                                "Do you really want to delete?"
                            )
                            if (confirmBox === true) {
                                onDelete(params.row.id)
                            }
                        }} data-toggle="tooltip" title="Delete" style={{ marginLeft: '20%' }} className="btn btn-danger" ><i className="fas fa-trash"></i></button>
                    </div>
                );
            }
        },
    ]
    const rows = readContact.data;
    //console.log(rows);
    return <>
        <Header />
        <Menu />
        <Modal show={showModal} onHide={handleClose}>
            <Modal.Header>
                <Modal.Title>Edit Customer</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <form onSubmit={onModalFormSubmit}>
                    <div className='form-group'>
                        <label>Id</label>
                        <input defaultValue={modalContact.id} onChange={onModalInputChange} className='form-control' type="text" name="id" />
                    </div>
                    <div className='form-group'>
                        <label>Name</label>
                        <input defaultValue={modalContact.name} onChange={onModalInputChange} className='form-control' type="text" name="name" pattern="^[a-zA-Z\s-]+$" title="Please enter Alphabets." required/>
                    </div>
                    <div className='form-group'>
                        <label>Address1</label>
                        <input defaultValue={modalContact.address1} onChange={onModalInputChange} className='form-control' type="text" name="address1" />
                    </div>
                    <div className='form-group'>
                        <label>Address2</label>
                        <input defaultValue={modalContact.address2} onChange={onModalInputChange} className='form-control' type="text" name="address2" />
                    </div>
                    <div className='form-group'>
                        <label>Address3</label>
                        <input defaultValue={modalContact.address3} onChange={onModalInputChange} className='form-control' type="text" name="address3" />
                    </div>
                    <div className='form-group'>
                        <label>Mobile Number</label>
                        <input defaultValue={modalContact.mobile_number} onChange={onModalInputChange} className='form-control' type="text" name="mobile_number" pattern="[789][0-9]{9}" title="Please enter valid mobile no" />
                    </div>
                    <div className='form-group'>
                        <label>Email Id</label>
                        <input defaultValue={modalContact.email_id} onChange={onModalInputChange} className='form-control' type="text" name="email_id" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$" title="Please enter valid email address"/>
                    </div>
                    <div className='form-group'>
                        <label>Website</label>
                        <input defaultValue={modalContact.website} onChange={onModalInputChange} className='form-control' type="text" name="website" />
                    </div>
                    <div className='form-group'>
                        <label>Director Name</label>
                        <input defaultValue={modalContact.director_name} onChange={onModalInputChange} className='form-control' type="text" name="director_name" pattern="^[a-zA-Z\s-]+$" title="Please enter Alphabets." required />
                    </div>
                    <div className='form-group'>
                        <label>Director Mobile Number</label>
                        <input defaultValue={modalContact.director_mobile} onChange={onModalInputChange} className='form-control' type="text" name="director_mobile_number" pattern="[789][0-9]{9}" title="Please enter valid mobile no"/>
                    </div>
                    <div className='form-group'>
                        <label>Director Email Id</label>
                        <input defaultValue={modalContact.director_email_id} onChange={onModalInputChange} className='form-control' type="text" name="director_email_id" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$" title="Please enter valid email address"/>
                    </div>
                    <div className='form-group'>
                        <label>Type Of Industry</label>
                        <input defaultValue={modalContact.type_of_industry} onChange={onModalInputChange} className='form-control' type="text" name="type_of_industry" />
                    </div>
                    <div className='form-group'>
                        <label>GST</label>
                        <input defaultValue={modalContact.gst} onChange={onModalInputChange} className='form-control' type="text" name="gst" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" title="Please enter valid gst"/>
                    </div>
                    <div className='form-group'>
                        <label>PAN</label>
                        <input defaultValue={modalContact.pan} onChange={onModalInputChange} className='form-control' type="text" name="pan" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Please enter valid pan"/>
                    </div>
                    <div className='form-group'>
                        <label>TAN</label>
                        <input defaultValue={modalContact.tan} onChange={onModalInputChange} className='form-control' type="text" name="tan"pattern='[A-Za-z]{4}[0-9]{5}[A-Za-z]{1}' title="Please enter valid tan" />
                    </div>
                    <div className='form-group'>
                        <label>Username</label>
                        <input defaultValue={modalContact.username} onChange={onModalInputChange} className='form-control' type="text" name="username" />
                    </div>
                    <div className='form-group'>
                        <label>Password</label>
                        <input defaultValue={modalContact.password} onChange={onModalInputChange} className='form-control' type="text" name="password" />
                    </div>
                    <hr />
                    {formValues1 === null ? [] : formValues1.map((element, index) => (
                        <div className="form-group" key={index}>
                            <label>Contact Person</label>
                            <input name="contact_person" className="form-control" type="text" value={element.contact_person || ""} onChange={e => handleChange1(index, e)} />
                            <label>Designation</label>
                            <input name="designation" className="form-control" type="text" value={element.designation || ""} onChange={e => handleChange1(index, e)} />
                            {
                                index ?
                                    <button type="button" className="btn btn-danger" onClick={() => removeFormFields1(index)}>Remove</button>
                                    : null
                            }
                        </div>
                    ))}
                    <div className="button-section">
                        <button className="btn btn-info" type="button" onClick={() => addFormFields1()}>Add</button>

                    </div>
                    <div className='form-group'>
                        <input className='btn btn-primary' type="submit" value="Update" />
                    </div>
                </form>
            </Modal.Body>
        </Modal>
        <Modal show={showModal1} onHide={handleClose1}>
            <Modal.Header>
                <Modal.Title>Show Customer</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <form>
                    <div className='form-group'>
                        <label>Id</label>
                        <input defaultValue={singleReadContact.id} className='form-control' type="text" name="id" readOnly />
                    </div>
                    <div className='form-group'>
                        <label>Name</label>
                        <input defaultValue={singleReadContact.name} className='form-control' type="text" name="name" readOnly pattern="^[a-zA-Z\s-]+$" title="Please enter Alphabets." required />
                    </div>
                    <div className='form-group'>
                        <label>Address1</label>
                        <input defaultValue={singleReadContact.address1} className='form-control' type="text" name="address1" readOnly />
                    </div>
                    <div className='form-group'>
                        <label>Address2</label>
                        <input defaultValue={singleReadContact.address2} className='form-control' type="text" name="address2" readOnly />
                    </div>
                    <div className='form-group'>
                        <label>Address3</label>
                        <input defaultValue={singleReadContact.address3} className='form-control' type="text" name="address3" readOnly />
                    </div>
                    <div className='form-group'>
                        <label>Mobile Number</label>
                        <input defaultValue={singleReadContact.mobile_number} className='form-control' type="text" name="mobile_number" readOnly pattern="[789][0-9]{9}" title="Please enter valid mobile no" />
                    </div>
                    <div className='form-group'>
                        <label>Email Id</label>
                        <input defaultValue={singleReadContact.email_id} className='form-control' type="text" name="email_id" readOnly pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$" title="Please enter valid email address"/>
                    </div>
                    <div className='form-group'>
                        <label>Website</label>
                        <input defaultValue={singleReadContact.website} className='form-control' type="text" name="website" readOnly />
                    </div>
                    <div className='form-group'>
                        <label>Director Name</label>
                        <input defaultValue={singleReadContact.director_name} className='form-control' type="text" name="director_name" readOnly pattern="^[a-zA-Z\s-]+$" title="Please enter Alphabets." required />
                    </div>
                    <div className='form-group'>
                        <label>Director Mobile Number</label>
                        <input defaultValue={singleReadContact.director_mobile} className='form-control' type="text" name="director_mobile_number" readOnly pattern="[789][0-9]{9}" title="Please enter valid mobile no" />
                    </div>
                    <div className='form-group'>
                        <label>Director Email Id</label>
                        <input defaultValue={singleReadContact.director_email_id} className='form-control' type="text" name="director_email_id" readOnly pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$" title="Please enter valid email address"/>
                    </div>
                    <div className='form-group'>
                        <label>Type Of Industry</label>
                        <input defaultValue={singleReadContact.type_of_industry} className='form-control' type="text" name="type_of_industry" readOnly />
                    </div>
                    <div className='form-group'>
                        <label>GST</label>
                        <input defaultValue={singleReadContact.gst} className='form-control' type="text" name="gst" readOnly pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" title="Please enter valid gst"/>
                    </div>
                    <div className='form-group'>
                        <label>PAN</label>
                        <input defaultValue={singleReadContact.pan} className='form-control' type="text" name="pan" readOnly pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Please enter valid pan"/>
                    </div>
                    <div className='form-group'>
                        <label>TAN</label>
                        <input defaultValue={singleReadContact.tan} className='form-control' type="text" name="tan" readOnly pattern='[A-Za-z]{4}[0-9]{5}[A-Za-z]{1}' title="Please enter valid tan" />
                    </div>
                    <div className='form-group'>
                        <label>Username</label>
                        <input defaultValue={singleReadContact.username} className='form-control' type="text" name="username"readOnly />
                    </div>
                    <div className='form-group'>
                        <label>Password</label>
                        <input defaultValue={singleReadContact.password} className='form-control' type="text" name="password" readOnly/>
                    </div>
                    <hr />
                    {formValues2 === null ? [] : formValues2.map((element, index) => (
                        <div className="form-group" key={index}>
                            <label>Contact Person</label>
                            <input name="contact_person" className="form-control" type="text"  value={element.contact_person || ""} onChange={e => handleChange2(index, e)} readOnly />
                            <label>Designation</label>
                            <input name="designation" className="form-control" type="text" value={element.designation || ""} onChange={e => handleChange2(index, e)} readOnly />

                        </div>
                    ))}

                </form>
            </Modal.Body>
        </Modal>
        <div className='content-wrapper'>
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Contact Form</h1>
                        </div>
                        {/* <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Form</li>
                            </ol>
                        </div> */}
                    </div>
                </div>
            </section>
            <section class="content">
                <div className="container-fluid">
                    <div className="row">
                        {/* left column */}
                        <div className="col-md-12">
                            {/* general form elements */}
                            <div className="card card-primary">
                                <div className="card-header">
                                    <h3 className="card-title">Company Contact</h3>
                                </div>
                                {/* /.card-header */}
                                {/* form start */}
                                <form onSubmit={onFormSubmit} id="contactsubmit">
                                    <div className="card-body">
                                        <div className="form-group">
                                            <label >Name</label>
                                            <input onChange={onInputChange} name="name" className="form-control" placeholder="Enter name" pattern="^[a-zA-Z\s-]+$" title="Please enter Alphabets." required />

                                        </div>
                                        <div className="form-group">
                                            <label >Address 1</label>
                                            <input onChange={onInputChange} name="address1" className="form-control" placeholder="Enter address 1" required />

                                        </div>
                                        <div className="form-group">
                                            <label >Address 2</label>
                                            <input onChange={onInputChange} name="address2" className="form-control" placeholder="Enter address 2" required />

                                        </div>
                                        <div className="form-group">
                                            <label >Address 3</label>
                                            <input onChange={onInputChange} name="address3" className="form-control" placeholder="Enter address 3" required />
                                        </div>
                                        <div className="form-group">
                                            <label >Mobile number</label>
                                            <input onChange={onInputChange} name="mobile_number" className="form-control" placeholder="Enter mobile number" required  pattern="[789][0-9]{9}" title="Please enter valid mobile no"/>
                                        </div>
                                        <div className="form-group">
                                            <label >Email Id</label>
                                            <input onChange={onInputChange} name="email_id" className="form-control" placeholder="Enter email id" required  title="Please enter valid email address"/>
                                        </div>
                                        <div className="form-group">
                                            <label >Website</label>
                                            <input onChange={onInputChange} name="website" className="form-control" placeholder="Enter website" required />
                                        </div>
                                        <div className="form-group">
                                            <label >Director Name </label>
                                            <input onChange={onInputChange} name="director_name" className="form-control" placeholder="Enter director name"  pattern="^[a-zA-Z\s-]+$" title="Please enter Alphabets." required />
                                        </div>
                                        <div className="form-group">
                                            <label >Director Mobile Number</label>
                                            <input onChange={onInputChange} name="director_mobile" className="form-control" placeholder="Enter director mobile number" required pattern="[789][0-9]{9}" title="Please enter valid mobile no" />
                                        </div>
                                        <div className="form-group">
                                            <label >Director Email Id </label>
                                            <input onChange={onInputChange} name="director_email_id" className="form-control" placeholder="Enter director email id" required  title="Please enter valid email address"/>
                                        </div>
                                        <div className="form-group">
                                            <label >Type of industry</label>
                                            <input onChange={onInputChange} name="type_of_industry" className="form-control" placeholder="Enter type of industry" required />
                                        </div>
                                        <div className="form-group">
                                            <label >GST</label>
                                            <input onChange={onInputChange} name="gst" className="form-control" placeholder="Enter GST" required pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" title="Please enter valid gst"/>
                                        </div>
                                        <div className="form-group">
                                            <label >Pan</label>
                                            <input onChange={onInputChange} name="pan" className="form-control" placeholder="Enter pan" required pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Please enter valid pan"/>
                                        </div>
                                        <div className="form-group">
                                            <label >Tan</label>
                                            <input onChange={onInputChange} name="tan" className="form-control" placeholder="Enter tan" required pattern='[A-Za-z]{4}[0-9]{5}[A-Za-z]{1}' title="Please enter valid tan"/>
                                        </div>
                                        <div className='form-group'>
                                            <label>Username</label>
                                            <input onChange={onInputChange} placeholder="Enter username" className='form-control' type="text" name="username" required />
                                        </div>
                                        <div className='form-group'>
                                            <label>Password</label>
                                            <input onChange={onInputChange} placeholder="Enter password" className='form-control' type="text" name="password" required />
                                        </div>
                                        {formValues.map((element, index) => (
                                            // <form onSubmit={onFormSubmit} id="contactperson">
                                            <div className="form-block" key={index} >
                                                <label>Contact Person</label>
                                                <input name="contact_person" placeholder="Enter contact person name" className="form-control" type="text"  value={element.contact_person || ""} onChange={e => handleChange(index, e)} />
                                                <label className='my-3'>Designation</label>
                                                <input name="designation" placeholder="Enter contact person designation" className="form-control" type="text"  value={element.designation || ""} onChange={e => handleChange(index, e)} />
                                                {
                                                    index ?
                                                        <button type="button" className="btn btn-danger" onClick={() => removeFormFields(index)}>Remove</button>
                                                        : null
                                                }
                                            </div>
                                            // </form>
                                        ))}
                                        <div className="button-section my-3">
                                            <button className="btn btn-info" type="button" onClick={() => addFormFields()}>Add</button>

                                        </div>
                                    </div>
                                    {/* /.card-body */}
                                    <div className="card-footer">
                                        <button type="submit" className="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div className="container-fluid">
                    <div className="row">
                        {/* left column */}
                        <div className="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Individual Contact</h3>
                                </div>
                                <div class="card-body">
                                    <div style={{ height: 300, width: '100%' }}>
                                        <DataGrid rows={rows} columns={columns} />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </>;
}

export default CompanyContact;
