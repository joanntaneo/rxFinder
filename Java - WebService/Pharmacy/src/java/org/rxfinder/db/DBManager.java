/*
 * DBManager - Controller that access the database 
 */
package org.rxfinder.db;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import org.rxfinder.DTO.*;


/**
 *
 * @author joann
 */
public class DBManager {
    
    public DBManager(){}
/*  
  *Connects to the database
*/
    private Connection connect(String url, String dbName, String userName, String password){
        Connection conn = null; 
        try { 
            Class.forName("com.mysql.jdbc.Driver").newInstance();
            conn = DriverManager.getConnection(url+dbName,userName,password); 
        } catch (Exception e) {
            e.printStackTrace(); 
            System.out.println(e.getMessage());
        }    
        return conn;
    }

/*  
  *Disconnects a database connection if available   
  */
    private void disconnect(Connection conn){
        if (conn != null){
            try{
                conn.close();
            }catch (SQLException e){
                 e.printStackTrace(); 
            }
        }
    }

/*  
  * Checks the log in credentials
  */ 
    public boolean checkLogin(String user, String password) {
        Connection conn = null; 
        boolean isOK = false;
        String url = "jdbc:mysql://localhost:3306/";//"jdbc:mysql://127.9.153.130:3306/";
        String dbName = "pharmacybr1"; 
        String userName = "pharmacy1";//"admin4ur2DEb"; 
        String passworddb = "pharmacy1" ;//"C62kbv8BwSBP"; 
        conn = connect(url, dbName, userName, passworddb);
        if(conn != null){
            String sql = "SELECT * FROM users WHERE username = '" + user + "'";
            ResultSet rs = null;
            Statement stmt = null;
            try {
                stmt = conn.createStatement();
                rs = stmt.executeQuery(sql);
                while (rs.next()){
                    String pwd = rs.getString("password");
                    if (pwd != null){
                        isOK = pwd.equals(password);
                    }
                }
            }catch (SQLException e ) {
                e.printStackTrace();
            } finally {
                disconnect(conn);
            }
        }
        return isOK;
    }
    
/*  
  * Actual retrieval of the data from the database given the product details
  */
    public List<rxProductDTO> getProductAvailability(rxProductDTO product) {
        List<rxProductDTO> list = new ArrayList<rxProductDTO>();
        Connection conn = null; 
        String url = "jdbc:mysql://localhost:3306/";//"jdbc:mysql://127.9.153.130:3306/";
        String dbName = "pharmacybr1"; 
        String userName = "pharmacy1";//"admin4ur2DEb"; 
        String password = "pharmacy1" ;//"C62kbv8BwSBP"; 
        conn = connect(url, dbName, userName, password);
        if (conn != null && product != null){
            String sql = "SELECT * FROM products ";
            String temp = "";
            if (!product.getProductGenericName().isEmpty() && 
                 !product.getProductGenericName().equals("*") ){
                temp = temp.concat( " genericName LIKE \'" + product.getProductGenericName() + "%\'" );
            }
            if (!product.getProductBrand().isEmpty() &&
                 !product.getProductBrand().equals("*")){
                if (!temp.isEmpty()){
                   temp = temp.concat(" AND ");
                }
                temp = temp.concat("brandName LIKE \'" +  product.getProductBrand() +"%\'");
            }
            if (!product.getProductUnit().isEmpty() &&
                 !product.getProductUnit().equals("*")){
                if (!temp.isEmpty()){
                   temp = temp.concat(" AND ");
                }
                temp = temp.concat("unit LIKE \'" + product.getProductUnit() + "%\'");
            }
            if (product.getProductVolume() > 0){
                if (!temp.isEmpty()){
                   temp = temp.concat(" AND ");
                }
                temp = temp.concat("volume = " + product.getProductVolume());
            }
            if (!temp.isEmpty()){
                temp = "WHERE " + temp;
                sql = sql.concat(temp);
            }
            System.out.println(sql);

            if (!sql.isEmpty()){
                rxProductDTO prod = null;
                ResultSet rs = null;
                Statement stmt = null;
                try {
                    stmt = conn.createStatement();
                    rs = stmt.executeQuery(sql);
                    while (rs.next()){
                        prod = new rxProductDTO();
                        prod.setProductGenericName(
                                rs.getString("genericName"));
                        prod.setProductBrand(
                                rs.getString("brandName"));
                        prod.setProductUnit(
                                rs.getString("unit"));
                        prod.setProductVolume(
                                rs.getInt("volume"));
                        prod.setPiecesAvailable(
                                rs.getInt("piecesAvailable"));
                        prod.setProductNotes(
                                rs.getString("notes"));
                         prod.setUnitperpc(
                                rs.getString("unitperpc"));
                        prod.setIsOverTheCounter(true);
                        list.add(prod);
                        prod = null;
                    }
                    stmt.close(); 
                }catch (SQLException e ) {
                   e.printStackTrace();
                } finally {
                    disconnect(conn);
                }
            }
        }
        return list;
    }
}
