import {createBrowserRouter} from "react-router-dom";
import {Navigate} from "react-router-dom";
import DefaultLayout from "../pages/layouts/DefaultLayout";
import Dashboard from "../pages/Private/Dashboard";
import Users from "../pages/Private/Users";
import Product from "../pages/Private/Produtos";
import Category from "../pages/Private/Categoria"
import GuestLayout from "../pages/layouts/GuestLayout";
import Login from "../pages/Public/Login";
import Signup from "../pages/Public/Signup";
import NotFound from "../pages/Public/NotFound";
import ProductIndex from "../pages/Public/Productindex/index";


const router = createBrowserRouter([
  {
    path: '/',
    element: <DefaultLayout />,
    children: [
      {
        path: '/',
        element: <Navigate to="/dashboard" />,
        abstract: true,
        title: 'Dashboard',
        description: 'Dashboard',
      },
      {
        path: '/dashboard',
        element: <Dashboard />,
      },
      {
        path: '/users',
        element: <Users />,
      },
      {
        path: '/product',
        element: <Product />,
      },
      {
      path: '/category',
      element: <Category />,
    },
    ]
  },
  {
    path: '/Productindex',
    element: <ProductIndex />,
  },
  {
    path: '/',
    element: <GuestLayout />,
    children: [
      {
        path: '/login',
        element: <Login />,
      },
      {
        path: '/signup',
        element: <Signup />,
      },
    ]
  },
  {
    path: '*',
    element: <NotFound />,
  }


]);

export default router;
