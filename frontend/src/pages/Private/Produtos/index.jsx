import React from "react";
import { useEffect, useState } from "react";
import { useSearchParams } from "react-router-dom";
import styles from "./styles.module.css";

import BaseApi from "../../../services/Api";
import { useStateContext } from "../../../context/ContextProvider";

import { toast } from "react-toastify";
import Swal from "sweetalert2";
import { findIndex } from "lodash";
import ModalUser from "../../../components/Modals/ModalUser";
import Pagination from "../../../components/Layout/Pagination";
import { Spinner } from "react-bootstrap";
import TableContainer from "../../../components/Layout/TableContainer";

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

export default function Produtos(){
    return(
        <h1>hello world</h1>
    )
}