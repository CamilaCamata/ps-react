import BaseApi from "../../../services/Api";
import {toast} from "react-toastify";
import Swal from "sweetalert2";
import React, {useEffect, useState} from "react";
import Tooltip from "../../Popups/Tooltip";
import {Modal, Spinner} from "react-bootstrap";
import Button from "../../Layout/Button";

const INITIAL_DATA = {
    total: 0,
    current_page: 1,
    last_page: 1,
    first_page_url: "",
    last_page_url: "",
    next_page_url: "",
    prev_page_url: null,
    path: "",
    from: 1,
    to: 1,
    data: [],
  };

const ModalProduct =({idProduct, onUpdate, onCreate, children}) =>{

    const [isLoading, setLoading] = React.useState(true);
    const [isSaving, setSaving] = React.useState(true);
    const [isShow, setShowModal] = React.useState(false);

    const [Name, setName] = useState(' ');
    const [isStock, setStok] = useState(' ');
    const [Image, setImage] = useState(null);
    const [Description, setDescription] = useState('');
    const [isCategory, setCategory] = useState(' ');
    const [natAPI, setNatAPI] = React.useState({ ...INITIAL_DATA});

    

    const getCategory = () =>{
        BaseApi
        .get("/categoria")
        .then((response) => {
            setNatAPI(response.data)
        }
        )
        .catch((err) => {
            if (err) {
              console.log(err);
              toast.error("Erro ao carregar dados da categoria");
              setTableData({ ...INITIAL_DATA });
              setLoading(false);
            }
          });
    
    const buildFormData = ()=>{
        const formData = new formData();
        formData.append("nome", name)
        formData.append("descrição",descrition)
        formData.append("quantidade",stock)
        formData.append("categorias_id",category)
        if (image){
            formData.append("imagem",image)
        }
        if (idProduct){
            formData.append("_method",PUT)
        }
        return formData
    } 

    const submitData = (e) => {
        e.preventDefault();
        setSaving(true);
        if (idProduct) {
          BaseApi.put(`/produto/${idProduct}`, {
            name: name,
            email: email
          }).then(res => {
            setSaving(false);
            setShowModal(false);
            toast.success('Product updated successfully!');
            onUpdate && onUpdate(res.data);
          }).catch(err => {
            console.log(err);
            Swal.fire('Oops!', err?.data?.errors?.[0] || err?.data?.message || 'Ocorreu um erro ao atualizar este produto', 'error');
            setSaving(false);
          })
        }
        else {
          BaseApi.post('/produto', {
            name: name,
            email: email,
            password: password,
            password_confirmation: passwordConfirmation,
          }).then(res => {
            setSaving(false);
            setShowModal(false);
            toast.success('Product created successfully!');
            onCreate && onCreate(res.data);
          }).catch(err => {
            console.log(err);
            Swal.fire('Oops!', err?.data?.errors?.[0] || err?.data?.message || 'Ocorreu um erro ao criar este produto.', 'error');
            setSaving(false);
          })
        }
      }
        
      const handleClose = () =>{
        setShowModal(false);
      }

      const handleChangeImage = (event) =>{
        const selectImage = event.target.files(0);
        setImage(selectImage);
      }
    }


}

export default ModalProduct;