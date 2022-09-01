<?php

namespace AditumPayments\ApiSDK\Domains;

class Customer
{
    private $id = "";
    private $name = "";
    private $email = "";
    private $documentType = 1;
    private $document = "";

    public $address = NULL;
    public $phone = NULL;

    public function __construct()
    {
        $this->address = new Address;
        $this->phone = new Phone;
    }

    public function setCustomer($document)
    {
        $this->customerController = new \AditumPayments\ApiSDK\Controller\Customer;
        $customerData = $this->customerController->get($document);

        foreach ($customerData as $keyCustomer => $data) {
            if (in_array($keyCustomer, ['phone', 'address'])) {
                foreach ($data as $keySub => $sub) {
                    $function = "set" . ucfirst($keySub);
                    $this->$keyCustomer->$function($sub);
                }
            } else {
                if (in_array($keyCustomer, ['entityType', 'gender', 'documentType'])) continue;
                $function = "set" . ucfirst($keyCustomer);
                $this->$function($data);
            }
        }
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;
    }

    public function getDocumentType()
    {
        return $this->documentType;
    }

    public function setDocument($document)
    {
        $this->document = $document;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function toString()
    {
        return array(
            "name" => $this->name,
            "email" => $this->email,
            "documentType" => $this->documentType,
            "document" =>  $this->document,
            "address" => $this->address->toString(),
            "phone" => $this->phone->toString()
        );
    }

    public function toJson()
    {
        return json_encode($this->toString());
    }
}
