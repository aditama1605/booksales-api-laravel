import API from "../api";

export const getGenres = async () => {
  const { data } = await API.get("/genres");
  return data.data;
};

export const createGenre = async (genreData) => {
  try {
    const response = await API.post("/genres", genreData);
    return response.data;
  } catch (error) {
    console.log(error);
    throw error;
  }
};
