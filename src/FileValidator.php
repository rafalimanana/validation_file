<?php 

namespace FileValidator;

class FileValidator
{
    /**
     * Mime types allowed
     */
    private $allowedMimeTypes = null;
    /**
     * Extensions allowed
     */
    private $allowedExtensions = null;
    /**
     * Max size for file
     */
    private $maxFileSize = null;

    public function __construct(
        $allowedMimeTypes = null,
        $allowedExtensions = null,
        $maxFileSize = 0
    )
    {
        $this->allowedMimeTypes = $allowedMimeTypes;
        $this->allowedExtensions = $allowedExtensions;
        $this->maxFileSize = $maxFileSize;
    }

    /**
     * @param $file
     * @param $dir
     * @param $file_name
     * @return boolean
     */
    public function uploadToPath($file, $dir, $file_name)
    {
        if(!$file || !$dir || !$file_name){
            return false;
        }
        if (!is_object($file)) {
            return false;
        }
        try {
            $file->move($dir, $file_name);
        }
        catch(\Exception $e){
            return false;
        }

        return true;
    }
    /**
     * @param $file
     * @return boolean
     */
    public function isImage($file){
        if(!$file){
            return false;
        }

        $mimetype = null;
        if (
            is_object($file) && 
            method_exists($file, 'getMimeType')
        ) {
            $mimetype = $file->getMimeType();
        }
        else if (is_string($file)) {
            $mimetype = $file;
        }

        if (!$mimetype) {
            return false;
        }

        if(
            ($mimetype == "image/jpeg") || 
            ($mimetype == "image/jpg") || 
            ($mimetype == "image/gif") || 
            ($mimetype == "image/svg") || 
            ($mimetype == "image/svg+xml") || 
            ($mimetype == "image/png")
        ) {
            return true;
        }

        return false;
    }
    /**
     * @param $file
     * @return boolean
     */
    public function isPdf($file){
        if(!$file){
            return false;
        }
        $mimetype = null;
        if (
            is_object($file) && 
            method_exists($file, 'getMimeType')
        ) {
            $mimetype = $file->getMimeType();
        }
        else if (is_string($file)) {
            $mimetype = $file;
        }

        if (!$mimetype) {
            return false;
        }

        if($mimetype == "application/pdf") {
            return true;
        }
        return false;
    }
    /**
     * @param $file
     * @return boolean
     */
    public function isDocx($file){
        if(!$file){
            return false;
        }
        $mimetype = null;
        if (
            is_object($file) && 
            method_exists($file, 'getMimeType')
        ) {
            $mimetype = $file->getMimeType();
        }
        else if (is_string($file)) {
            $mimetype = $file;
        }

        if (!$mimetype) {
            return false;
        }
        if (
            $mimetype == 'application/msword' || 
            $mimetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || 
            $mimetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.documentapplication/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ) {
            return true;
        }
        return false;
    }
    /**
     * @param $file
     * @return boolean
     */
    public function isExcel($file){
        if(!$file){
            return false;
        }
        $mimetype = null;
        if (
            is_object($file) && 
            method_exists($file, 'getMimeType')
        ) {
            $mimetype = $file->getMimeType();
        }
        else if (is_string($file)) {
            $mimetype = $file;
        }

        if (!$mimetype) {
            return false;
        }        
        if (
            $mimetype == 'application/vnd.ms-excel' ||  
            $mimetype == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||  
            $mimetype == 'application/octet-stream'
        ) {
            return true;
        }
        return false;
    }
    /**
     * @param $file
     * @return boolean
     */
    public function isVideo($file){
        if(!$file){
            return false;
        }
        $mimetype = null;
        if (
            is_object($file) && 
            method_exists($file, 'getMimeType')
        ) {
            $mimetype = $file->getMimeType();
        }
        else if (is_string($file)) {
            $mimetype = $file;
        }

        if (!$mimetype) {
            return false;
        }
        if (
            $mimetype == 'video/mp4' || 
            $mimetype == 'video/avi' || 
            $mimetype == 'video/mpeg' || 
            $mimetype == 'video/mkv' 
        ) {
            return true;
        }
        return false;
    }
    /**
     * @param $file
     * @return string|null
     */
    public function getFileType($file)
    {
        if (!$file) {
            return null;
        }
        $mimetype = null;
        if (
            is_object($file) && 
            method_exists($file, 'getMimeType')
        ) {
            $mimetype = $file->getMimeType();
        }
        else if (is_string($file)) {
            $mimetype = $file;
        }
        if (!$mimetype) {
            return null;
        }

        if (strpos($mimetype, 'video') !== false){
            return "video";
        }

        if ($mimetype == 'application/pdf' ) {
            return "pdf";
        }
        
        if (
            $mimetype == 'application/msword' || 
            $mimetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || 
            $mimetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.documentapplication/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ) {
            return "docx";
        }
        
        if (
            $mimetype == 'application/vnd.ms-excel' ||  
            $mimetype == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||  
            $mimetype == 'application/octet-stream'
        ) {
            return "excel";
        }
        
        if(
            $mimetype == "image/svg" || 
            $mimetype == "image/svg+xml"
        ) {
            return "svg";
        }

        if(
            $mimetype == "image/jpeg" || 
            $mimetype == "image/jpg" || 
            $mimetype == "image/gif" || 
            $mimetype == "image/png"
        ) {
            return "image";
        }

        if ($mimetype == 'video/mp4') {
            return "video";
        }

        return null;
    }

    /**
     * @param $file
     * @param $max_mb
     * @return boolean
     */
    public function validSize($file, $max_mb=1){
        if(!$file){
            return false;
        }
        $fileSize = null;
        if (
            is_object($file) && 
            method_exists($file, 'getSize')
        ) {
            $fileSize = $file->getSize();
        }
        else if (is_string($file) || is_integer($file)) {
            $fileSize = $file;
        }
        $mega = 1048576;
        if($fileSize <= ($max_mb * $mega)){
            return true;
        }
        return false;
    }

    /**
     * @param $file
     * @return boolean
     */
    public function validateMimeType($file): bool
    {
        if(!$file){
            return false;
        }
        $mimetype = null;
        if (
            is_object($file) && 
            method_exists($file, 'getMimeType')
        ) {
            $mimetype = $file->getMimeType();
        }
        else if (is_string($file)) {
            $mimetype = $file;
        }
        if (!$mimetype) {
            return false;
        }
        if ($this->allowedMimeTypes) {
            if (is_array($this->allowedMimeTypes)) {
                return in_array($mimetype, $this->allowedMimeTypes);
            }
            else if (is_string($this->allowedMimeTypes)) {
                return ($mimetype == $this->allowedMimeTypes);
            }
        }
        return false;
    }

    /**
     * @param $file
     * @return boolean
     */
    public function validateExtension($file): bool
    {
        if(!$file){
            return false;
        }
        $fileName = null;
        if (
            is_object($file) && 
            method_exists($file, 'getClientOriginalName')
        ) {
            $fileName = $file->getClientOriginalName();
        }
        else if (is_string($file)) {
            $fileName = $file;
        }
        if (!$fileName) {
            return false;
        }
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($this->allowedExtensions) {
            if (is_array($this->allowedExtensions)) {
                return in_array($fileExtension, $this->allowedExtensions);
            }
            else if (is_string($this->allowedExtensions)) {
                return (
                    $fileExtension == $this->allowedExtensions
                );
            }
        }
        return false;
    }

    /**
     * @param $file
     * @return boolean
     */
    public function validateSize($file): bool
    {
        if(!$file){
            return false;
        }
        $fileSize = null;
        if (
            is_object($file) && 
            method_exists($file, 'getSize')
        ) {
            $fileSize = $file->getSize();
        }
        else if (is_string($file) || is_integer($file)) {
            $fileSize = $file;
        }
        if (!$fileSize) {
            return false;
        }
        if ($this->maxFileSize) {
            return $fileSize <= $this->maxFileSize;
        }
        return false;
    }


    /**
     * @param $file
     * @return boolean
     */
    public function validateFile($file): bool
    {
        if (!$file) {
            return false;
        }
        $type = null;
        $name = null;
        $size = null;
        if (is_array($file)) {
            if (isset($file["type"])) {
                $type = $file["type"];
            }
            if (isset($file["name"])) {
                $name = $file["name"];
            }
            if (isset($file["fileName"])) {
                $name = $file["fileName"];
            }
            if (isset($file["file_name"])) {
                $name = $file["file_name"];
            }
            if (isset($file["size"])) {
                $size = $file["size"];
            }
        }
        else if (is_object($file)) {
            if ( 
                method_exists($file, 'getSize')
            ) {
                $size = $file->getSize();
            }
            if ( 
                method_exists($file, 'getMimeType')
            ) {
                $type = $file->getMimeType();
            }
            if ( 
                method_exists($file, 'getClientOriginalName')
            ) {
                $name = $file->getClientOriginalName();
            }
        }
        if (!$size || !$type || !$name) {
            return false;
        }
        return (
            $this->validateMimeType($type) &&
            $this->validateExtension($name) &&
            $this->validateSize($size)
        );
    }

    /**
     * @param $data
     * @return array
     */
    public function analyseFileByVirustotal(
        $data = []
    )
    {
        $file = null;
        $virustotalApiKey = null;
        if (isset($data["file"])) {
            $file = $data["file"];
        }
        if (isset($data["virustotalApiKey"])) {
            $virustotalApiKey = $data["virustotalApiKey"];
        }
        if(!$file || !is_object($file)) {
            return [
                "status"=>500,
                "code"=>"error_file",
            ];
        }
        if(!$virustotalApiKey)) {
            return [
                "status"=>500,
                "code"=>"error_key",
            ];
        }
        $virustotalUrl = 'https://www.virustotal.com/api/v3/files';
        
        // Préparer les données multipart pour cURL
        $postData = [
            'file' => curl_file_create(
                $file->getRealPath(), 
                $file->getMimeType(), 
                $file->getClientOriginalName()
            )
        ];

        try {
            // Créer une ressource cURL
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $virustotalUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['x-apikey: ' . $virustotalApiKey]);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            
            // Exécuter la requête cURL
            $response = curl_exec($curl);
            
            // Gérer les erreurs cURL
            if (curl_errno($curl)) {
                $errorMessage = 'Erreur cURL : ' . curl_error($curl);
                return [
                    "status"=>500,
                    "code"=>"error_curl",
                    "message"=>$errorMessage,
                ];
            }
            
            curl_close($curl);
            
            $result = json_decode($response, true);

            // Vérification si le fichier est sûr selon la réponse de VirusTotal
            $data = [];
            $attributes = [];
            $last_analysis_stats = [];
            $malicious = null;
            if (isset($result['data'])) {
                $data = $result['data'];
            }
            if (isset($data["attributes"])) {
                $attributes = $data["attributes"];
            }
            if (isset($attributes["last_analysis_stats"])) {
                $last_analysis_stats = $attributes["last_analysis_stats"];
            }
            if (isset($last_analysis_stats["malicious"])) {
                $malicious = $last_analysis_stats["malicious"];
            }
            // Vérification si le fichier est sûr selon la réponse de VirusTotal
            if ($malicious === 0) {
                return [
                    "status"=>200
                ];
            }
            else {
                return [
                    "status"=>500,
                    "code"=>"error_danger",
                ];
            }
        }
        catch(\Exception $e){
            return [
                "status"=>500,
                "code"=>"error_analyse",
            ];
        }
        return [
            "status"=>500,
            "code"=>"error_analyse",
        ];
    }
}