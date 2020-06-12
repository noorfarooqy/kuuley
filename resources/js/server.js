export default class  {
  constructor(onProgress) {
    this.req = null;
    this.error = null;
    this.data =  null;
    this.config = {
      onUploadProgress(progressEvent) {
       var percentCompleted = Math.round((progressEvent.loaded * 100) /
         progressEvent.total);
 
       // execute the callback
       if (onProgress) 
       {
         console.log('progress ',percentCompleted);
         onProgress(percentCompleted,0)
       }
 
       return percentCompleted;
     },
     onDownloadProgress(progressEvent){

        var percentCompleted = Math.round((progressEvent.loaded * 100) /
        progressEvent.total);

        // execute the callback
        if (onProgress) 
        {
          console.log('progress ',percentCompleted);
          onProgress(percentCompleted, 1)
        }

        return percentCompleted;
     }
   };
  }
  setRequest(req)
  {
    console.log('will set request ',req);
    this.req = req;
  }
  serverRequest(url, successCallback, errorCallback,progressBar=null)
  {
      //args contains list of functions or additional properties
      //for the successCallback
    axios.post(url, this.req, this.config).
    then(response => {
      response = response.data;
      if(response.hasOwnProperty('error_message'))
      {
        console.log('server error ',response.error_message);
        this.error = response.error_message;
        errorCallback(this.error);
        return false;
      }
      else if(response.hasOwnProperty("success_message"))
      {
        console.log('success request ',response);
        this.data = response.data;
        successCallback(this.data);
        return true;
      }
      else
      {
        console.log('error reposen ',response);
        this.error = response.errorMessage[0];
        errorCallback(this.error);
        return false;
      }
    })
    .catch(error => {
      console.log("server error ",error);
      errorCallback(error);
    })
  }
  previewFile(input, successCallback, errorCallback)
  {
    if(input.files && input.files[0])
    {
      var reader = new FileReader();
      reader.onload = (e) => {
        successCallback(e);
      }
      reader.onerror = (error) => {
        errorCallback(error);
      }
      reader.onabort = (interupt) => {
        errorCallback(interupt);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  getError()
  {
    return this.error;
  }
  getData()
  {
    return this.data;
  }
}
