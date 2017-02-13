/*
 * rxProductDTO - an object that contains the attributes of a product
 */
package org.rxfinder.DTO;

/**
 *
 * @author joann
 */
public class rxProductDTO {
    
    String productGenericName;
    String productBrand;
    int piecesAvailable;
    String productUnit;
    int productVolume;
    boolean isOverTheCounter;
    String productNotes;
    String unitperpc;
    
    public rxProductDTO(){
    }

    public String getProductGenericName() {
        return productGenericName;
    }

    public void setProductGenericName(String productGenericName) {
        this.productGenericName = productGenericName;
    }

    public String getProductBrand() {
        return productBrand;
    }

    public void setProductBrand(String productBrand) {
        this.productBrand = productBrand;
    }

    public int getPiecesAvailable() {
        return piecesAvailable;
    }

    public void setPiecesAvailable(int piecesAvailable) {
        this.piecesAvailable = piecesAvailable;
    }

    public String getProductUnit() {
        return productUnit;
    }

    public void setProductUnit(String productUnit) {
        this.productUnit = productUnit;
    }

    public int getProductVolume() {
        return productVolume;
    }

    public void setProductVolume(int productVolume) {
        this.productVolume = productVolume;
    }

    public boolean isIsOverTheCounter() {
        return isOverTheCounter;
    }

    public void setIsOverTheCounter(boolean isOverTheCounter) {
        this.isOverTheCounter = isOverTheCounter;
    }

    public String getProductNotes() {
        return productNotes;
    }

    public void setProductNotes(String productNotes) {
        this.productNotes = productNotes;
    }

    public String getUnitperpc() {
        return unitperpc;
    }

    public void setUnitperpc(String unitperpc) {
        this.unitperpc = unitperpc;
    }
    
    
}
