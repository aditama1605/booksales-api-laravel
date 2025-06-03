import API from "../api";

export const getGenres = async () => {
  const response = await API.get("/genres");
  return response.data.data;
};

export const createGenre = async (data) => {
  const response = await API.post("/genres", data);
  return response.data;
};

export const updateGenre = async (id, data) => {
  const response = await API.put(`/genres/${id}`, data);
  return response.data;
};

export const deleteGenre = async (id) => {
  const response = await API.delete(`/genres/${id}`);
  return response.data;
};
