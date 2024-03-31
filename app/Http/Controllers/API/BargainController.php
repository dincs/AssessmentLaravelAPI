<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BargainController extends Controller
{
  public function search(){
    $_url = 'https://webservices.cert.platform.sabre.com';
    $soapUser = '2j0le31cfij3jeqz';
    $soapPassword = 'mn2M0HaW';
    $soapToken = 'T1RLAQK0GvXjUEBOMuAq/UL/qTlOTO0ApfIktbhhcB6/WLYBCxC3pdn7ROs2sa6n170TjYbJAADg2W4wT75kadxlfnFztqTxFIKPLKAhB//2lIE37dQ+AX9OWxPNy4knHUSzquYVvXepzdL7kPAntOfUfAtxb0FzZIUxjMS4UPF7mN4rx4YONblhOWJHDCuVcEVUTYYY3idkPaNJZ++H6o0YDTS9Uwpu51dIBF2x9FuSHsB4E3jg7G6NfENKS1iQIi03yEyQFjTMSGnna7Ytk7uF45qUWWMomL0oezzIBI5ItG4rXSfPJpSX3xeKcT9M8DnkTrJ9iHZjvd4sAwDFkI6GEXurM8fSiwICRJpgbRolIiJGf2mfYaE*';
    $soapEnvelope = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2020/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2020/XMLSchema">
            <SOAP-ENV:Header>
                <m:MessageHeader xmlns:m="http://www.ebxml.org/namespaces/messageHeader">
                    <m:From>
                        <m:PartyId type="urn:x12.org:IO5:01">99999</m:PartyId>
                    </m:From>
                    <m:To>
                        <m:PartyId type="urn:x12.org:IO5:01">123123</m:PartyId>
                    </m:To>
                    <m:CPAId>ABC</m:CPAId>
                    <m:ConversationId>abc123</m:ConversationId>
                    <m:Service m:type="OTA">Air Shopping Service</m:Service>
                    <m:Action>BargainFinderMaxRQ</m:Action>
                    <m:MessageData>
                        <m:MessageId></m:MessageId>
                        <m:Timestamp>2021-02-15T11:15:12Z</m:Timestamp>
                        <m:TimeToLive>2021-02-15T11:15:12Z</m:TimeToLive>
                    </m:MessageData>
                    <m:DuplicateElimination/>
                    <m:Description>Bargain Finder Max Service</m:Description>
                </m:MessageHeader>
                <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
                    <wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">'.$soapToken.'</wsse:BinarySecurityToken>
                </wsse:Security>
            </SOAP-ENV:Header>
            <SOAP-ENV:Body>
                <OTA_AirLowFareSearchRQ xmlns:xs="http://www.w3.org/2020/XMLSchema" xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:xsi="http://www.w3.org/2020/XMLSchema-instance" Target="Production" Version="6.8.0" ResponseType="OTA" ResponseVersion="6.7.0">
                    <POS>
                        <Source PseudoCityCode="PCC">
                            <RequestorID ID="1" Type="1">
                                <CompanyName Code="TN"/>
                            </RequestorID>
                        </Source>
                    </POS>
                    <OriginDestinationInformation RPH="1">
                        <DepartureDateTime>2023-09-01T11:00:00</DepartureDateTime>
                        <OriginLocation LocationCode="DFW"/>
                        <DestinationLocation LocationCode="CDG"/>
                        <TPA_Extensions>
                            <SegmentType Code="O"/>
                        </TPA_Extensions>
                    </OriginDestinationInformation>
                    <OriginDestinationInformation RPH="2">
                        <DepartureDateTime>2023-09-15T11:00:00</DepartureDateTime>
                        <OriginLocation LocationCode="CDG"/>
                        <DestinationLocation LocationCode="DFW"/>
                        <TPA_Extensions>
                            <SegmentType Code="O"/>
                        </TPA_Extensions>
                    </OriginDestinationInformation>
                    <TravelPreferences ValidInterlineTicket="true">
                        <CabinPref PreferLevel="Preferred" Cabin="Y"/>
                        <TPA_Extensions>
                            <TripType Value="Return"/>
                            <LongConnectTime Min="780" Max="1200" Enable="true"/>
                            <ExcludeCallDirectCarriers Enabled="true"/>
                        </TPA_Extensions>
                    </TravelPreferences>
                    <TravelerInfoSummary>
                        <SeatsRequested>1</SeatsRequested>
                        <AirTravelerAvail>
                            <PassengerTypeQuantity Code="ADT" Quantity="1"/>
                        </AirTravelerAvail>
                    </TravelerInfoSummary>
                    <TPA_Extensions>
                        <IntelliSellTransaction>
                            <RequestType Name="50ITINS"/>
                        </IntelliSellTransaction>
                    </TPA_Extensions>
                </OTA_AirLowFareSearchRQ>
            </SOAP-ENV:Body>
        </SOAP-ENV:Envelope>';

        $headers = array(
            'Content-Type: text/xml',
            'Accept: text/xml',
            'Cache-Control: no-cache',
            "Pragma: no-cache",
            "SOAPAction: BargainFinderMaxRQ",
            'Content-length: '.strlen($soapEnvelope)
        );
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_URL, $_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $soapEnvelope);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            curl_close($ch);

            $response1 = str_replace("<soap:Body>","",$response);
            $response2 = str_replace("</soap:Body>","",$response1);

            $parser = simplexml_load_string($response2);   
            // echo $parser->asXML(); 
            
            $parser->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');

            $body = $parser->xpath('//soap:Body');
            if (!empty($body)) {
                $bodyElement = $body[0];
                $bodyOTA_AirLowFareSearchRS = $bodyElement->OTA_AirLowFareSearchRS;
                if($bodyOTA_AirLowFareSearchRS->Errors){
                    foreach ($bodyOTA_AirLowFareSearchRS->Errors->Error as $error) {
                        $type = (string) $error['Type'];
                        $code = (string) $error['Code'];
                        $shortText = (string) $error['ShortText'];
                    }

                    $response = array(
                        'status' => 'failed',
                        'message' => 'Operation unsuccessful.',
                        'data' => $bodyOTA_AirLowFareSearchRS->Errors->Error[5],
                    );
            
                    return response()->json($response, 403);
                }

                if($bodyOTA_AirLowFareSearchRS->PricedItineraries){
                    // echo $bodyOTA_AirLowFareSearchRS->PricedItineraries;

                    $response = array(
                        'status' => 'success',
                        'message' => 'Operation success.',
                        'data' => $bodyOTA_AirLowFareSearchRS->PricedItineraries,
                    );
            
                    return response()->json($response, 200);
                }
            } else {
                echo "Body element not found in the response\n";
            }
  }
    
}
