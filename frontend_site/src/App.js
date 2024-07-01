import logo from './logo.svg';
import './App.css';
import Header from './Layout/Header/Header';
import Home from './Pages/Home';
import 'rsuite/dist/rsuite.min.css';
import Footer from './Layout/Footer/Footer';
import { Route, Routes } from 'react-router-dom';
import CitiesListings from './Pages/CitiesListings';
import PropertyDetail from './Pages/PropertyDetail';
import RightSelling from './Pages/Selling/RightSelling';
import TipsSellingExterior from './Pages/Selling/TipsSellingExterior';
import TipsSellingInterior from './Pages/Selling/TipsSellingInterior';
import SellingMistakes from './Pages/Selling/SellingMistakes';
import ClientsTestimonials from './Pages/ClientsTestimonials';

import SurvivngSale from './Pages/Selling/SurvivngSale';
import Rentals from './Pages/Rentals';
import HomeEvalution from './Pages/HomeEvalution';
import ContactUs from './Pages/ContactUs';
import Properties from './Pages/Properties';
import Neighborhoods from './Pages/Neighborhoods/Neighborhoods';
import Search from './Pages/Search';
import BorderUpdate from './Pages/BorderUpdate/BorderUpdate';
import Login from './Pages/Login';
function App() {

  return (
  
    <>
      <div>
        <Header />
        <Routes>
          <Route path='/' element={<Home />} />
          <Route path='/login' element={<Login />} />
          <Route path='/city/:slug' element={<CitiesListings />} />
          <Route path='/property/:slug' element={<PropertyDetail />} />
          <Route path='/the-right-selling-price' element={<RightSelling />} />
          <Route path='/surviving-the-sale' element={<SurvivngSale />} />
          <Route path='/rentals' element={<Rentals />} />
          <Route path='/home-evaluation' element={<HomeEvalution />} />
          <Route path='/contact_us' element={<ContactUs />} />
          <Route path='/tips-for-increasing-your-homes-appeal-exterior' element={<TipsSellingExterior />} />
          <Route path='/tips-for-increasing-your-homes-appeal-interior' element={<TipsSellingInterior />} />
          <Route path='/common-home-selling-mistakes-and-how-to-avoid-them' element={<SellingMistakes />} />
          <Route path='/client-testimonials' element={<ClientsTestimonials />} />
          <Route path='/property' element={<Properties />} />
          <Route path='/neighborhood/:slug' element={<Neighborhoods />} />
          <Route path='/search' element={<Search />} />
         
          <Route path='/border-wait-times' element={<BorderUpdate />} />

        </Routes>

        <Footer />
      </div>
    </>
  );
}

export default App;
