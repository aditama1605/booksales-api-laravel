import API from "../api";

export const getAuthors = async () => {
  const { data } = await API.get("/authors");
  return data.data;
};

export const createAuthor = async (authorData) => {
  try {
    const response = await API.post("/authors", authorData);
    return response.data;
  } catch (error) {
    console.log(error);
    throw error;
  }
};
