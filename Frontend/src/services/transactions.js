import API from "../api";

export const createTransaction = async (data) => {
  try {
    const response = await API.post("/transactions", data, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("accessToken")}`,
      },
    });
    return response;
  } catch (err) {
    console.log(err);
    throw err;
  }
};
