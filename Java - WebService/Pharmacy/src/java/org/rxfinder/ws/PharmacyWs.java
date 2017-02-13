/*
 * PharmacyWS 
 */
package org.rxfinder.ws;

import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import org.rxfinder.DTO.*;
import org.rxfinder.db.*;
import java.util.*;

/**
 *
 * @author joann
 */
@WebService(serviceName = "PharmacyWs")
public class PharmacyWs {

    /**
     * This is a  web service operation that retrieves the list of products as specied by the requesting party
     */
    @WebMethod(operationName = "getProductAvailability")
    public List<rxProductDTO> getProductAvailability (
            @WebParam(name = "username") String username, 
            @WebParam(name = "password") String password,
            @WebParam(name = "genericName") String genericName, 
            @WebParam(name = "brandName") String brandName, 
            @WebParam(name = "unit") String unit, 
            @WebParam(name = "volume") String volume){
        
        DBManager db = new DBManager();
        List<rxProductDTO> list = null;
        boolean bAccessOk = db.checkLogin(username, password);

        if(bAccessOk){        
            rxProductDTO prod = new rxProductDTO();
            prod.setProductGenericName(genericName);
            prod.setProductBrand(brandName);
            prod.setProductUnit(unit);
            prod.setProductVolume(Integer.parseInt(volume));

            list = db.getProductAvailability(prod);            
        }
        return list;
    }


}
