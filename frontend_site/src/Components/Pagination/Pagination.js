import React, { useState, useEffect } from "react";


const Paginations = ({ users, totalRecords, currentPage, setCurrentPage, usersPerPage, UsersToDisplay }) => {


  const totalPages = Math.ceil(totalRecords / usersPerPage);

  const startIndex = (currentPage - 1) * usersPerPage;

  const endIndex = startIndex + usersPerPage;

  const handlePageChange = (page) => {
    setCurrentPage(page);
  };

  useEffect(() => {
    if (currentPage < 1) {
      setCurrentPage(1);
    } else if (currentPage > totalPages) {
      setCurrentPage(1);
    }
  }, [currentPage, totalPages]);

  useEffect(() => {
    const startIndex = (currentPage - 1) * parseInt(usersPerPage);
    const endIndex = startIndex + parseInt(usersPerPage);

    const displayedUsers = users?.slice(startIndex, endIndex);

    UsersToDisplay(displayedUsers);
  }, [users, usersPerPage, currentPage]);


  const FirstPage = () => {
    setCurrentPage(1);
  };

  const LastPage = () => {
    setCurrentPage(totalPages);
  };

  const maxVisiblePages = 5;
  const pageRange = Math.min(maxVisiblePages, totalPages);
  const startPage = Math.max(currentPage - Math.floor(pageRange / 2), 1);
  const endPage = Math.min(startPage + pageRange - 1, totalPages);
  const pagesToRender = Array.from({ length: pageRange }, (_, index) =>
    startPage + index
  ).filter((page) => page >= 1 && page <= totalPages);
  return (
    <div>
     
      <div className="col-12 text-center text-md-start offset-custom-11">
        <ul className="pagination mb-3  mt-2  ">
          <li className={currentPage === 1 ? " disabled " : ""}> <a  href="javascript:void(0);" onClick={() => handlePageChange(currentPage - 1)} tabindex="-1"><span className="fa-chevron-left" /></a> </li>
          {pagesToRender.map(pageNumber => (
            <li className={currentPage === pageNumber ? "active" : ""}><a onClick={() => handlePageChange(pageNumber)}  href="javascript:void(0);">{pageNumber}</a></li>
          ))}

          <li className={currentPage === totalPages ? " disabled  " : " "}> <a  href="javascript:void(0);" onClick={() => handlePageChange(currentPage + 1)} > <span className="fa-chevron-right" /></a> </li>
        </ul>
      </div>
    </div>
  );
};

export default Paginations;
